import './bootstrap';
import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

import.meta.glob(['../images/**', '../fonts/**']);

Alpine.start();
