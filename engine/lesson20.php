<?php
function getFolders() {
    return getAssocResult("SELECT id, name, child FROM folders");
}