<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$calender_event_type = array(
	1 => 'Fundraiser',
	2 => 'Fete',
	3 => 'Open Day',
	4 => 'Information Seminar',
	5 => 'Incursion',
	6 => 'Excursion',
	7 => 'Guest Speaker',
	8 => 'Workshop',
	9 => 'Formal',
	10 => 'Graduation Ceremony',
	11 => 'Camp',
	23 => 'Sporting Competition',
);
$config['calender_event_type'] = $calender_event_type;

$special_need_category = array(
	1 => 'Intellectual',
	2 => 'Physical',
	3 => 'Acquired brain injury',
	4 => 'Neurological',
	5 => 'Dual Sensory',
	6 => 'Vision',
	7 => 'Hearing',
	8 => 'Speech',
	9 => 'Psychiatric',
	10 => 'Developmental delay',
);
$config['special_need_category'] = $special_need_category;

$calender_event_color = array(
	1 => '#fffb02',
	2 => '#fe44a5',
	3 => '#ff4e01',
	4 => '#9b0033',
	5 => '#6b14fa',
	6 => '#4ccafd',
	7 => '#209351',
	8 => '#a7f832',
	9 => '#f6103b',
	// 10 => '#f78c01',
	10 => '#ae71da',
	11 => '#bbb2b3',
	23 => '#e5d0a1',
);
$config['calender_event_color'] = $calender_event_color;