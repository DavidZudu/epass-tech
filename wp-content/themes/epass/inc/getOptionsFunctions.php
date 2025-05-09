<?php
use Flynt\Utils\Options;
function getCodeSnippets() {
    return Options::getGlobal('CodeSnippets');
}
function getContactInfo() {
    return Options::getGlobal('ContactInfo');
}