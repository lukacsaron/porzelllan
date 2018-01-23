<?php

//top header bar
add_action('chandelier_elated_before_page_header', 'chandelier_elated_get_header_top');

//mobile header
add_action('chandelier_elated_after_page_header', 'chandelier_elated_get_mobile_header');