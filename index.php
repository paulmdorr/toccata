<?php
include 'core/Toccata.php';

Toccata::bootstrap();
Toccata::setLogger(new BasicLogger());
Toccata::start();