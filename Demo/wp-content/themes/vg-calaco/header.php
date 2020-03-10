<?php
/*
 * This is driver page. DO NOT MODIFY!!!
 */

$layout = vg_calaco_get_default_layout();
switch($layout)
{
	case "layout-8":
		get_template_part('template-parts/layout-8', 'header');
		break;
	case "layout-7":
		get_template_part('template-parts/layout-7', 'header');
		break;
	case "layout-6":
		get_template_part('template-parts/layout-6', 'header');
		break;
	case "layout-5":
		get_template_part('template-parts/layout-5', 'header');
		break;
	case "layout-4":
		get_template_part('template-parts/layout-4', 'header');
		break;
	case "layout-3":
		get_template_part('template-parts/layout-3', 'header');
		break;
	case "layout-2":
		get_template_part('template-parts/layout-2', 'header');
		break;
	default:
		get_template_part('template-parts/layout-1', 'header');
		break;
}