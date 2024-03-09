import './bootstrap';
import 'flowbite';
import L from 'leaflet';

window.L = L;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import.meta.glob(['../images/**', '../fonts/**']);

Alpine.start();
