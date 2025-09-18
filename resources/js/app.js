import './bootstrap';
import mask from '@alpinejs/mask';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist'
import { createIcons, icons } from 'lucide';

// Alpine
window.Alpine = Alpine;
Alpine.plugin(persist)
Alpine.plugin(mask);
Alpine.start();

// Lucide
createIcons({ icons });