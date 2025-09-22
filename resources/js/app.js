import './bootstrap';
import mask from '@alpinejs/mask';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
import { createIcons, icons } from 'lucide';
import flatpickr from 'flatpickr';
import 'flatpickr/dist/l10n/pt.js';

// Alpine
window.Alpine = Alpine;
Alpine.plugin(persist)
Alpine.plugin(mask);
Alpine.start();
window.flatpickr = flatpickr;

// Lucide
createIcons({ icons });