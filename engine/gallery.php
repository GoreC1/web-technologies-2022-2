<?php
function getGallery($path) {
    return array_splice(scandir($path), 2);
}