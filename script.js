let map;
let markers = [];
let infoWindow;

function initMap() {
    const defaultCenter = { lat: 21.146633, lng: 79.08886 };
    map = new google.maps.Map(document.getElementById('rangesMap'), {
        center: defaultCenter,
        zoom: 5,
        mapTypeControl: false,
        streetViewControl: false,
    });

    infoWindow = new google.maps.InfoWindow();
    bindFilters();
    loadRanges();
}

function bindFilters() {
    const stateSelect = document.getElementById('stateSelect');
    const districtSelect = document.getElementById('districtSelect');
    const filterButton = document.getElementById('filterButton');

    if (stateSelect && districtSelect) {
        stateSelect.addEventListener('change', () => updateDistricts(stateSelect, districtSelect));
    }

    if (filterButton) {
        filterButton.addEventListener('click', () => loadRanges());
    }

    const toggle = document.getElementById('menuToggle');
    const mobileMenu = document.getElementById('mobileMenu');
    if (toggle && mobileMenu) {
        toggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    updateDistricts(stateSelect, districtSelect);
}

function updateDistricts(stateSelect, districtSelect) {
    if (!stateSelect || !districtSelect) return;

    const selectedState = stateSelect.value;
    const districts = selectedState && districtLookup[selectedState]
        ? districtLookup[selectedState]
        : Array.from(new Set(Object.values(districtLookup).flat()));

    districtSelect.innerHTML = '<option value="">All Districts</option>';
    districts.sort().forEach((district) => {
        const option = document.createElement('option');
        option.value = district;
        option.textContent = district;
        districtSelect.appendChild(option);
    });
}

async function loadRanges() {
    const state = document.getElementById('stateSelect')?.value || '';
    const district = document.getElementById('districtSelect')?.value || '';

    const params = new URLSearchParams();
    if (state) params.append('state', state);
    if (district) params.append('district', district);

    try {
        const response = await fetch(`api/get_ranges.php?${params.toString()}`);
        if (!response.ok) {
            throw new Error('Unable to load ranges');
        }
        const payload = await response.json();
        renderRanges(payload.data || []);
    } catch (error) {
        console.error(error);
    }
}

function renderRanges(ranges) {
    clearMarkers();

    if (!map) return;

    if (!ranges.length) {
        map.setCenter({ lat: 21.146633, lng: 79.08886 });
        map.setZoom(5);
        return;
    }

    const bounds = new google.maps.LatLngBounds();

    ranges.forEach((range) => {
        const position = { lat: range.lat, lng: range.lng };
        const marker = new google.maps.Marker({
            position,
            map,
            title: range.name,
        });

        marker.addListener('click', () => {
            const safeName = range.name;
            const link = `range.php?code=${encodeURIComponent(range.hash_code)}`;
            infoWindow.setContent(`
                <div class="text-sm">
                    <div class="font-semibold mb-1">${safeName}</div>
                    <a class="text-blue-600" href="${link}">View Range</a>
                </div>
            `);
            infoWindow.open({ anchor: marker, map, shouldFocus: false });
        });

        markers.push(marker);
        bounds.extend(position);
    });

    map.fitBounds(bounds);
}

function clearMarkers() {
    markers.forEach((marker) => marker.setMap(null));
    markers = [];
}

document.addEventListener('DOMContentLoaded', () => {
    // initMap is invoked by Google Maps callback
});
