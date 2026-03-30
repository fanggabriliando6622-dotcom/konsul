{{--
    REUSABLE LOCATION PICKER COMPONENT
    Shopee-style: Map + Autocomplete + Geolocation
    
    Props:
    - $inputName   : name attribute for the address textarea (default: 'alamat')
    - $latName     : name attribute for latitude hidden input (default: 'latitude')
    - $lngName     : name attribute for longitude hidden input (default: 'longitude')
    - $address     : pre-filled address value
    - $latitude    : pre-filled latitude
    - $longitude   : pre-filled longitude
    - $mapId       : unique ID for the map container (default: 'locationMap')
    - $placeholder : placeholder text for search input
--}}

@props([
    'inputName'   => 'alamat',
    'latName'     => 'latitude',
    'lngName'     => 'longitude',
    'address'     => '',
    'latitude'    => '',
    'longitude'   => '',
    'mapId'       => 'locationMap',
    'placeholder' => 'Cari alamat atau nama tempat...',
])

<div class="loc-picker" id="locPicker_{{ $mapId }}">
    {{-- Search Bar with Autocomplete --}}
    <div class="loc-search-wrap">
        <div class="loc-search-box">
            <i class="icofont-search-2 loc-search-icon"></i>
            <input 
                type="text" 
                class="loc-search-input" 
                id="locSearch_{{ $mapId }}"
                placeholder="{{ $placeholder }}"
                autocomplete="off"
            >
            <div class="loc-search-spinner" id="locSpinner_{{ $mapId }}">
                <i class="icofont-spinner-alt-1"></i>
            </div>
            <button type="button" class="loc-btn-clear" id="locClear_{{ $mapId }}" title="Hapus pencarian">
                <i class="icofont-close-line"></i>
            </button>
        </div>
        {{-- Autocomplete Dropdown --}}
        <div class="loc-autocomplete" id="locAutocomplete_{{ $mapId }}"></div>
    </div>

    {{-- Map Container --}}
    <div class="loc-map-wrapper">
        <div class="loc-map" id="{{ $mapId }}"></div>

        {{-- Floating GPS Button --}}
        <button type="button" class="loc-btn-gps" id="locGps_{{ $mapId }}" title="Gunakan lokasi saat ini">
            <i class="icofont-location-arrow"></i>
            <span class="loc-gps-text">Lokasi Saya</span>
        </button>

        {{-- Accuracy Badge --}}
        <div class="loc-accuracy-badge" id="locAccuracy_{{ $mapId }}"></div>

        {{-- Coordinate Display --}}
        <div class="loc-coords" id="locCoords_{{ $mapId }}"></div>
    </div>

    {{-- Selected Address Display --}}
    <div class="loc-selected" id="locSelected_{{ $mapId }}">
        <div class="loc-selected-icon">
            <i class="icofont-location-pin"></i>
        </div>
        <div class="loc-selected-info">
            <span class="loc-selected-label">Alamat Terpilih</span>
            <p class="loc-selected-address" id="locSelectedAddr_{{ $mapId }}">
                {{ $address ?: 'Belum ada alamat dipilih — cari atau pin di peta' }}
            </p>
        </div>
        <button type="button" class="loc-btn-edit" id="locEdit_{{ $mapId }}" title="Edit alamat manual">
            <i class="icofont-ui-edit"></i>
        </button>
    </div>

    {{-- Hidden Inputs --}}
    <input type="hidden" name="{{ $latName }}" id="locLat_{{ $mapId }}" value="{{ $latitude }}">
    <input type="hidden" name="{{ $lngName }}" id="locLng_{{ $mapId }}" value="{{ $longitude }}">
    
{{-- Address textarea (visible when editing manual / old method) --}}
    <div class="loc-manual-edit" id="locManualEdit_{{ $mapId }}" style="display: none;">
        <h6 class="fw-bold mb-3" style="font-size: 13px; color: #223a66;">
            <i class="icofont-list me-1"></i> Lengkapi Detail Alamat
        </h6>
        
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <select class="form-select loc-select-field" id="locProv_{{ $mapId }}" required>
                    <option value="">Pilih Provinsi</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-select loc-select-field" id="locKab_{{ $mapId }}" disabled required>
                    <option value="">Pilih Kabupaten/Kota</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-select loc-select-field" id="locKec_{{ $mapId }}" disabled required>
                    <option value="">Pilih Kecamatan</option>
                </select>
            </div>
            <div class="col-md-6">
                <select class="form-select loc-select-field" id="locKel_{{ $mapId }}" disabled required>
                    <option value="">Pilih Kelurahan/Desa</option>
                </select>
            </div>
        </div>
        <div class="row g-2 mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control loc-input-field" id="locKodePos_{{ $mapId }}" placeholder="Kode Pos" required>
            </div>
            <div class="col-md-8">
                <input type="text" class="form-control loc-input-field" id="locDetail_{{ $mapId }}" placeholder="Nama jalan, Gedung, No. Rumah (Keterangan lengkap)" required>
            </div>
        </div>
        <div class="d-none">
            <textarea 
                id="locAddress_{{ $mapId }}" 
                class="loc-address-textarea"
                rows="2"
                placeholder="Tulis alamat lengkap Anda..."
            >{{ $address }}</textarea>
        </div>
        <button type="button" class="loc-btn-save-addr w-100 justify-content-center" id="locSaveAddr_{{ $mapId }}">
            <i class="icofont-check"></i> Simpan Alamat
        </button>
    </div>
    <input type="hidden" name="{{ $inputName }}" id="locAddressHidden_{{ $mapId }}" value="{{ $address }}">
</div>
