/**
 * =====================================================
 *  LOCATION PICKER — Shopee-style
 *  Leaflet + OpenStreetMap + Nominatim + Geolocation
 * =====================================================
 *
 *  Usage:
 *    new LocationPicker({
 *        mapId: 'locationMap',
 *        lat:   -6.2,
 *        lng:   106.816666,
 *        zoom:  15,
 *        onSelect: function(data) { console.log(data); }
 *    });
 */

class LocationPicker {
    constructor(options = {}) {
        this.mapId       = options.mapId || 'locationMap';
        this.defaultLat  = parseFloat(options.lat) || -6.2;
        this.defaultLng  = parseFloat(options.lng) || 106.816666;
        this.defaultZoom = options.zoom || 15;
        this.onSelect    = options.onSelect || null;

        // DOM element IDs derived from mapId
        this.ids = {
            search:      'locSearch_'      + this.mapId,
            spinner:     'locSpinner_'     + this.mapId,
            clear:       'locClear_'       + this.mapId,
            autocomplete:'locAutocomplete_'+ this.mapId,
            gps:         'locGps_'         + this.mapId,
            accuracy:    'locAccuracy_'    + this.mapId,
            coords:      'locCoords_'      + this.mapId,
            selected:    'locSelected_'    + this.mapId,
            selectedAddr:'locSelectedAddr_'+ this.mapId,
            edit:        'locEdit_'        + this.mapId,
            manualEdit:  'locManualEdit_'  + this.mapId,
            address:     'locAddress_'     + this.mapId,
            addressHidden:'locAddressHidden_'+ this.mapId,
            saveAddr:    'locSaveAddr_'    + this.mapId,
            lat:         'locLat_'         + this.mapId,
            lng:         'locLng_'         + this.mapId,
            prov:        'locProv_'        + this.mapId,
            kab:         'locKab_'         + this.mapId,
            kec:         'locKec_'         + this.mapId,
            kel:         'locKel_'         + this.mapId,
            kodepos:     'locKodePos_'     + this.mapId,
            detail:      'locDetail_'      + this.mapId,
        };

        this.map    = null;
        this.marker = null;
        this.searchTimer = null;

        this._init();
    }

    /* ── Initialization ───────────────────────── */
    _init() {
        // Check if Leaflet loaded
        if (typeof L === 'undefined') {
            console.error('Leaflet.js is not loaded!');
            return;
        }

        this._initMap();
        this._initMarker();
        this._bindSearch();
        this._bindGPS();
        this._bindEdit();
        this._bindMapClick();
        this._initRegionDropdowns();
    }

    /* ── Map Setup ────────────────────────────── */
    _initMap() {
        const lat = this._getEl(this.ids.lat)?.value || this.defaultLat;
        const lng = this._getEl(this.ids.lng)?.value || this.defaultLng;

        this.map = L.map(this.mapId, {
            center: [parseFloat(lat), parseFloat(lng)],
            zoom: this.defaultZoom,
            zoomControl: false,
        });

        // Add zoom control to top-right
        L.control.zoom({ position: 'topright' }).addTo(this.map);

        // OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OSM</a>',
            maxZoom: 19,
        }).addTo(this.map);
    }

    /* ── Custom Marker ────────────────────────── */
    _initMarker() {
        const lat = parseFloat(this._getEl(this.ids.lat)?.value) || this.defaultLat;
        const lng = parseFloat(this._getEl(this.ids.lng)?.value) || this.defaultLng;

        const icon = L.divIcon({
            className: 'loc-custom-pin',
            html: `
                <div class="loc-pin-inner">
                    <div class="loc-pin-head"><i class="icofont-location-pin"></i></div>
                    <div class="loc-pin-tail"></div>
                    <div class="loc-pin-pulse"></div>
                </div>`,
            iconSize:   [40, 52],
            iconAnchor: [20, 52],
        });

        this.marker = L.marker([lat, lng], {
            icon: icon,
            draggable: true,
        }).addTo(this.map);

        // On marker drag end → reverse geocode
        this.marker.on('dragend', () => {
            const pos = this.marker.getLatLng();
            this._updateCoordinates(pos.lat, pos.lng);
            this._reverseGeocode(pos.lat, pos.lng);
        });

        // If we have existing coordinates, reverse geocode to show address
        const existingAddr = this._getEl(this.ids.addressHidden)?.value;
        if (lat !== this.defaultLat && lng !== this.defaultLng && !existingAddr) {
            this._reverseGeocode(lat, lng);
        }
    }

    /* ── Map Click → Move Pin ─────────────────── */
    _bindMapClick() {
        this.map.on('click', (e) => {
            const { lat, lng } = e.latlng;
            this.marker.setLatLng([lat, lng]);
            this.map.panTo([lat, lng]);
            this._updateCoordinates(lat, lng);
            this._reverseGeocode(lat, lng);
        });
    }

    /* ── Search & Autocomplete (Nominatim) ────── */
    _bindSearch() {
        const searchInput = this._getEl(this.ids.search);
        const clearBtn    = this._getEl(this.ids.clear);
        const dropdown    = this._getEl(this.ids.autocomplete);

        if (!searchInput) return;

        // Debounced search on input
        searchInput.addEventListener('input', () => {
            const query = searchInput.value.trim();
            clearBtn?.classList.toggle('active', query.length > 0);

            if (query.length < 3) {
                dropdown?.classList.remove('active');
                return;
            }

            clearTimeout(this.searchTimer);
            this.searchTimer = setTimeout(() => this._searchNominatim(query), 400);
        });

        // Close dropdown on click outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('#locPicker_' + this.mapId)) {
                dropdown?.classList.remove('active');
            }
        });

        // Clear button
        clearBtn?.addEventListener('click', () => {
            searchInput.value = '';
            clearBtn.classList.remove('active');
            dropdown?.classList.remove('active');
            searchInput.focus();
        });

        // Enter key → search
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query.length >= 3) this._searchNominatim(query);
            }
        });
    }

    async _searchNominatim(query) {
        const spinner  = this._getEl(this.ids.spinner);
        const dropdown = this._getEl(this.ids.autocomplete);

        spinner?.classList.add('active');

        try {
            const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=6&addressdetails=1&countrycodes=id&accept-language=id`;
            const res = await fetch(url, {
                headers: { 'User-Agent': 'RuangKonsul/1.0' }
            });
            const data = await res.json();

            spinner?.classList.remove('active');
            this._renderAutocomplete(data, dropdown);
        } catch (err) {
            spinner?.classList.remove('active');
            console.error('Nominatim search error:', err);
        }
    }

    _renderAutocomplete(results, dropdown) {
        if (!dropdown) return;

        if (!results || results.length === 0) {
            dropdown.innerHTML = `
                <div class="loc-ac-empty">
                    <i class="icofont-search-2"></i>
                    Alamat tidak ditemukan. Coba kata kunci lain.
                </div>`;
            dropdown.classList.add('active');
            return;
        }

        let html = '';
        results.forEach((item) => {
            const name = item.display_name.split(',')[0];
            const detail = item.display_name;
            const typeIcon = this._getTypeIcon(item.type);

            html += `
                <div class="loc-ac-item" 
                     data-lat="${item.lat}" 
                     data-lng="${item.lon}"
                     data-display="${this._escapeHtml(item.display_name)}">
                    <div class="loc-ac-icon"><i class="${typeIcon}"></i></div>
                    <div class="loc-ac-text">
                        <span class="loc-ac-name">${this._escapeHtml(name)}</span>
                        <span class="loc-ac-detail">${this._escapeHtml(detail)}</span>
                    </div>
                </div>`;
        });

        dropdown.innerHTML = html;
        dropdown.classList.add('active');

        // Bind click on items
        dropdown.querySelectorAll('.loc-ac-item').forEach((item) => {
            item.addEventListener('click', () => {
                const lat = parseFloat(item.dataset.lat);
                const lng = parseFloat(item.dataset.lng);
                const display = item.dataset.display;

                this.marker.setLatLng([lat, lng]);
                this.map.flyTo([lat, lng], 17, { duration: 1.2 });
                this._updateCoordinates(lat, lng);
                this._setAddress(display);

                dropdown.classList.remove('active');
                this._getEl(this.ids.search).value = display.split(',')[0];
            });
        });
    }

    _getTypeIcon(type) {
        const icons = {
            house:     'icofont-home',
            building:  'icofont-building',
            hospital:  'icofont-ambulance-cross',
            school:    'icofont-graduate-alt',
            shop:      'icofont-cart',
            restaurant:'icofont-restaurant',
            hotel:     'icofont-hotel',
            park:      'icofont-tree',
            mosque:    'icofont-mosque',
            church:    'icofont-church',
        };
        return icons[type] || 'icofont-location-pin';
    }

    /* ── HTML5 Geolocation ────────────────────── */
    _bindGPS() {
        const gpsBtn = this._getEl(this.ids.gps);
        if (!gpsBtn) return;

        gpsBtn.addEventListener('click', () => {
            if (!navigator.geolocation) {
                alert('Browser Anda tidak mendukung geolokasi.');
                return;
            }

            gpsBtn.classList.add('loading');
            const gpsText = gpsBtn.querySelector('.loc-gps-text');
            if (gpsText) gpsText.textContent = 'Mencari...';

            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    const accuracy = Math.round(position.coords.accuracy);

                    this.marker.setLatLng([lat, lng]);
                    this.map.flyTo([lat, lng], 17, { duration: 1.5 });
                    this._updateCoordinates(lat, lng);
                    this._reverseGeocode(lat, lng);

                    // Show accuracy badge
                    const badge = this._getEl(this.ids.accuracy);
                    if (badge) {
                        badge.innerHTML = `<i class="icofont-check-circled"></i> Akurasi: ${accuracy}m`;
                        badge.classList.add('active');
                        setTimeout(() => badge.classList.remove('active'), 5000);
                    }

                    gpsBtn.classList.remove('loading');
                    if (gpsText) gpsText.textContent = 'Lokasi Saya';
                },
                (error) => {
                    gpsBtn.classList.remove('loading');
                    if (gpsText) gpsText.textContent = 'Lokasi Saya';

                    let msg = 'Gagal mendapatkan lokasi.';
                    if (error.code === 1) msg = 'Akses lokasi ditolak. Izinkan di pengaturan browser.';
                    if (error.code === 2) msg = 'Lokasi tidak tersedia saat ini.';
                    if (error.code === 3) msg = 'Waktu pencarian habis. Coba lagi.';
                    alert(msg);
                },
                {
                    enableHighAccuracy: true,
                    timeout: 15000,
                    maximumAge: 0,
                }
            );
        });
    }

    /* ── Manual Address Edit ──────────────────── */
    _bindEdit() {
        const editBtn    = this._getEl(this.ids.edit);
        const manualEdit = this._getEl(this.ids.manualEdit);
        const saveBtn    = this._getEl(this.ids.saveAddr);
        const selected   = this._getEl(this.ids.selected);
        const textarea   = this._getEl(this.ids.address);
        const hiddenAddr = this._getEl(this.ids.addressHidden);

        editBtn?.addEventListener('click', () => {
            const isShown = manualEdit.style.display !== 'none';
            manualEdit.style.display = isShown ? 'none' : 'block';
        });

        saveBtn?.addEventListener('click', () => {
            // Build the final address from dropdowns + inputs
            this._buildAddressFromDropdowns();
            manualEdit.style.display = 'none';
        });
    }

    /* ── Region API (Shopee Style) ────────────── */
    _initRegionDropdowns() {
        const provSelect = this._getEl(this.ids.prov);
        const kabSelect  = this._getEl(this.ids.kab);
        const kecSelect  = this._getEl(this.ids.kec);
        const kelSelect  = this._getEl(this.ids.kel);

        if (!provSelect) return;

        // Fetch Provinces
        fetch('https://kanglerian.github.io/api-wilayah-indonesia/api/provinces.json')
            .then(r => r.json())
            .then(data => {
                data.forEach(p => {
                    const opt = document.createElement('option');
                    opt.value = p.id;
                    opt.textContent = p.name;
                    provSelect.appendChild(opt);
                });
            });

        // Event Listeners for cascading selects
        provSelect.addEventListener('change', () => {
            const val = provSelect.value;
            kabSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kabSelect.disabled = true;
            kecSelect.disabled = true;
            kelSelect.disabled = true;

            if (val) {
                kabSelect.disabled = false;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/regencies/${val}.json`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(k => {
                            const opt = document.createElement('option');
                            opt.value = k.id;
                            opt.textContent = k.name;
                            kabSelect.appendChild(opt);
                        });
                    });
            }
        });

        kabSelect.addEventListener('change', () => {
            const val = kabSelect.value;
            kecSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kecSelect.disabled = true;
            kelSelect.disabled = true;

            if (val) {
                kecSelect.disabled = false;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/districts/${val}.json`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(k => {
                            const opt = document.createElement('option');
                            opt.value = k.id;
                            opt.textContent = k.name;
                            kecSelect.appendChild(opt);
                        });
                    });
            }
        });

        kecSelect.addEventListener('change', () => {
            const val = kecSelect.value;
            kelSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            kelSelect.disabled = true;

            if (val) {
                kelSelect.disabled = false;
                fetch(`https://kanglerian.github.io/api-wilayah-indonesia/api/villages/${val}.json`)
                    .then(r => r.json())
                    .then(data => {
                        data.forEach(k => {
                            const opt = document.createElement('option');
                            opt.value = k.id;
                            opt.textContent = k.name;
                            kelSelect.appendChild(opt);
                        });
                    });
            }
        });
    }

    _buildAddressFromDropdowns() {
        const detail  = this._getEl(this.ids.detail)?.value || '';
        const kodepos = this._getEl(this.ids.kodepos)?.value || '';

        const provSel = this._getEl(this.ids.prov);
        const kabSel  = this._getEl(this.ids.kab);
        const kecSel  = this._getEl(this.ids.kec);
        const kelSel  = this._getEl(this.ids.kel);

        const provName = provSel && provSel.options[provSel.selectedIndex].text !== 'Pilih Provinsi' ? provSel.options[provSel.selectedIndex].text : '';
        const kabName  = kabSel && kabSel.options[kabSel.selectedIndex].text !== 'Pilih Kabupaten/Kota' ? kabSel.options[kabSel.selectedIndex].text : '';
        const kecName  = kecSel && kecSel.options[kecSel.selectedIndex].text !== 'Pilih Kecamatan' ? kecSel.options[kecSel.selectedIndex].text : '';
        const kelName  = kelSel && kelSel.options[kelSel.selectedIndex].text !== 'Pilih Kelurahan/Desa' ? kelSel.options[kelSel.selectedIndex].text : '';

        // Form the string: Detail Alamat, Kelurahan, Kecamatan, Kabupaten, Provinsi, Kode Pos
        const parts = [];
        if (detail) parts.push(detail);
        if (kelName) parts.push('Kel. ' + kelName);
        if (kecName) parts.push('Kec. ' + kecName);
        if (kabName) parts.push(kabName);
        if (provName) parts.push('Prov. ' + provName);
        if (kodepos) parts.push('Kode Pos: ' + kodepos);

        const fullAddr = parts.join(', ');

        if (fullAddr) {
            this._setAddress(fullAddr);
        }
    }

    /* ── Reverse Geocode ──────────────────────── */
    async _reverseGeocode(lat, lng) {
        try {
            const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=id`;
            const res = await fetch(url, {
                headers: { 'User-Agent': 'RuangKonsul/1.0' }
            });
            const data = await res.json();

            if (data && data.display_name) {
                this._setAddress(data.display_name);
            }
        } catch (err) {
            console.error('Reverse geocode error:', err);
        }
    }

    /* ── Helpers ───────────────────────────────── */
    _updateCoordinates(lat, lng) {
        const latEl = this._getEl(this.ids.lat);
        const lngEl = this._getEl(this.ids.lng);
        if (latEl) latEl.value = lat.toFixed(8);
        if (lngEl) lngEl.value = lng.toFixed(8);

        // Coordinate display
        const coordsEl = this._getEl(this.ids.coords);
        if (coordsEl) {
            coordsEl.textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            coordsEl.classList.add('active');
        }
    }

    _setAddress(address) {
        const selectedAddr = this._getEl(this.ids.selectedAddr);
        const hiddenAddr   = this._getEl(this.ids.addressHidden);
        const textarea     = this._getEl(this.ids.address);

        if (selectedAddr) selectedAddr.textContent = address;
        if (hiddenAddr)   hiddenAddr.value = address;
        if (textarea)     textarea.value = address;

        if (this.onSelect) {
            this.onSelect({
                address:   address,
                latitude:  this._getEl(this.ids.lat)?.value,
                longitude: this._getEl(this.ids.lng)?.value,
            });
        }
    }

    _getEl(id) {
        return document.getElementById(id);
    }

    _escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    /* ── Public Methods ───────────────────────── */
    setLocation(lat, lng, zoom) {
        this.marker.setLatLng([lat, lng]);
        this.map.flyTo([lat, lng], zoom || 17, { duration: 1 });
        this._updateCoordinates(lat, lng);
        this._reverseGeocode(lat, lng);
    }

    getLocation() {
        return {
            latitude:  this._getEl(this.ids.lat)?.value || null,
            longitude: this._getEl(this.ids.lng)?.value || null,
            address:   this._getEl(this.ids.addressHidden)?.value || '',
        };
    }

    invalidateSize() {
        if (this.map) this.map.invalidateSize();
    }
}
