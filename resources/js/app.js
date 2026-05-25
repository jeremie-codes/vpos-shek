import './bootstrap';
import QRCode from 'qrcode';

// On attache QRCode à l'objet window pour que tes fonctions onclick HTML puissent le voir
window.QRCode = QRCode;
