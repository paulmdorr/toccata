<?php
include 'Core/Toccata.php';

Toccata::bootstrap();
Toccata::setLogger(new BasicLogger());
Toccata::start();