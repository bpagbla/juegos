<?php


if (!empty($_SESSION["promocionesActivas"])) {
    echo true;
} else {
    echo false;
}
