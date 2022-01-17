<?php

		
$background_shape_def = [
	'duration'			=> '2500',
	'delay'				=> '0',
	'easing'			=> 'easeOutQuad',
	'elasticity'		=> '400',
	'scaleX'			=> '0.9',
	'scaleY'			=> '0.9',
	'translateX'		=> '0',
	'translateY'		=> '0',
	'rotate'			=> '0'
];

$path_def = [
	'duration'			=> '1500',
	'delay'				=> '0',
	'easing'			=> 'easeOutQuad',
	'elasticity'		=> '400',
	'scaleX'			=> '0.9',
	'scaleY'			=> '0.9',
	'translateX'		=> '0',
	'translateY'		=> '0',
	'rotate'			=> '0',
];

$image_def = [
	'duration'			=> '2000',
	'delay'				=> '0',
	'easing'			=> 'easeOutElastic',
	'elasticity'		=> '400',
	'scaleX'			=> '1.1',
	'scaleY'			=> '1.1',
	'translateX'		=> '0',
	'translateY'		=> '0',
	'rotate'			=> '0',
];

$background_shapes_array = [];
$foreground_shapes_array = [];

// Triangle rotation 0

$foreground_shapes_array[] = [ 
	'path-start' => 'M 425.19903,237.13547 C 394.81904,150.86547 291.179,38.445457 204.939,68.795457 118.699,99.145457 36.059001,277.17547 66.409001,363.42547 96.759001,449.67546 200.869,452.94546 287.119,422.59546 373.36904,392.24547 455.55903,323.37547 425.19903,237.13547 Z', 
	'path-end' => 'M 433.19903,229.13547 C 413.30579,130.13156 305.30793,73.454562 204.939,80.795447 72.546937,90.478473 36.059001,277.17547 66.409001,363.42547 96.759001,449.67546 213.81232,445.88852 287.119,434.59546 390.40652,418.68378 451.20129,318.77355 433.19903,229.13547 Z',
	'path-duration' 	=> '1700',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutBack',
	'path-elasticity' 	=> '1500',
	'path-scaleX' 		=> '1.1',
	'path-scaleY' 		=> '1.1',
	'path-translateX' 	=> $path_def['translateX'],
	'path-translateY'	=> '-20',
	'path-rotate'		=> '15',
	'image-duration' 	=> $image_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeInOutQuart',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '40',
	'image-rotate'		=> $image_def['rotate']
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 432.77835,226.29008 C 462.69362,75.6278 262.32051,65.4776 173.95107,41.551745 85.58162,17.625869 140.73738,116.97123 110.8221,267.6335 80.9068,418.29578 38.342527,455.60093 128.28643,467.87027 233.89681,482.24407 402.86305,376.95235 432.77835,226.29008 Z',
	'deco-duration' 	=> '3000',
	'deco-delay' 		=> $background_shape_def['delay'],
	'deco-easing' 		=> 'easeInOutBack',
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '0.8',
	'deco-scaleY' 		=> '1',
	'deco-translateX' 	=> $background_shape_def['translateX'],
	'deco-translateY' 	=> '-10',
	'deco-rotate' 		=> '-20'
];

// Triangle rotation 1

$foreground_shapes_array[] = [
	'path-start' => 'M 425.19903,237.13547 C 394.81904,150.86547 291.179,38.445457 204.939,68.795457 118.699,99.145457 36.059001,277.17547 66.409001,363.42547 96.759001,449.67546 200.869,452.94546 287.119,422.59546 373.36904,392.24547 455.55903,323.37547 425.19903,237.13547 Z',
	'path-end' => 'M 425.19903,237.13547 C 394.81904,150.86547 291.179,38.445457 204.939,68.795457 118.699,99.145457 36.059001,277.17547 66.409001,363.42547 96.759001,449.67546 200.869,452.94546 287.119,422.59546 373.36904,392.24547 455.55903,323.37547 425.19903,237.13547 Z',
	'path-duration' 	=> '2500',
	'path-delay' 		=> $path_def['delay'],
	'path-rotate'		=> '10',
	'path-easing' 		=> 'easeOutElastic',
	'path-elasticity' 	=> '600',
	'path-scaleX' 		=> '1.2',
	'path-scaleY' 		=> '1.1',
	'path-translateX' 	=> '15',
	'path-translateY' 	=> $path_def['translateY'],
	'image-duration' 	=> $image_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> $image_def['easing'],
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> '5',
	'image-translateY'	=> '30',
	'image-rotate'		=> '-20'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 326.67461,66.429365 C 210.72907,-29.199802 81.635556,104.0561 53.888695,211.82761 c -18.98616,73.74407 85.339665,-7.02468 201.285185,88.60448 115.94553,95.6292 93.75453,221.6625 144.02917,147.34017 59.00353,-87.2828 43.41708,-285.71371 -72.52844,-381.342895 z',
	'deco-duration' 	=> '1500',
	'deco-delay' 		=> '500',
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '1.1',
	'deco-scaleY' 		=> '1',
	'deco-translateX' 	=> $background_shape_def['translateX'],
	'deco-translateY' 	=> '-20',
	'deco-rotate' 		=> '20'
];

// Triangle to circle 2

$foreground_shapes_array[] = [ 
	'path-start' => 'm 393.99268,223.51984 c 29.41683,61.19078 80.51915,143.02991 42.42812,199.22359 -35.45105,52.23373 -123.51297,31.4911 -186.68372,31.86824 C 186.66061,455.08309 97.35413,478.08856 62.638496,425.28912 24.01005,366.64403 83.315133,283.76777 115.09851,221.16272 148.00387,156.10627 180.81495,52.063101 253.69703,52.110243 327.52196,52.157386 362.03017,156.95484 393.99268,223.51984 Z',
	'path-end' => 'm 433.99268,163.51984 c 29.41683,61.19078 20.51915,163.02991 -17.57188,219.22359 -35.45105,52.23373 -103.51297,71.4911 -166.68372,71.86824 C 186.66061,455.08309 119.35413,424.08856 84.638496,371.28912 46.01005,312.64403 43.315133,223.76777 75.09851,161.16272 108.00387,96.10627 180.81495,52.063101 253.69703,52.110243 327.52196,52.157386 402.03017,96.95484 433.99268,163.51984 Z',
	'path-duration' 	=> '1700',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutBack',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1.1',
	'path-scaleY' 		=> '1.1',
	'path-translateX' 	=> $path_def['translateX'],
	'path-translateY'	=> '-20',
	'path-rotate'		=> $path_def['rotate'],
	'image-duration' 	=> $image_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeInOutQuart',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '40',
	'image-rotate'		=> $image_def['rotate']
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 49.011022,175.95086 C 83.619565,106.14703 181.26543,66.115817 258.86731,73.185158 342.242,80.784464 430.63243,144.53156 460.82145,222.60662 c 24.4162,63.02786 10.88319,153.7842 -39.36876,198.92577 C 342.242,492.79362 188.36317,514.08682 103.08628,450.20723 28.531699,394.2771 7.614209,259.42019 49.011022,175.95086 Z',
	'deco-duration' 	=> $background_shape_def['duration'],
	'deco-delay' 		=> $background_shape_def['delay'],
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '0.6',
	'deco-scaleY' 		=> '1.1',
	'deco-translateX' 	=> $background_shape_def['translateX'],
	'deco-translateY' 	=> '-20',
	'deco-rotate' 		=> $background_shape_def['rotate']
];

// Language cloud 3

$foreground_shapes_array[] = [ 
	'path-start' => 'M 290.54656,62.1723 C 199.58662,46.22731 111.79918,101.74228 95.314184,195.76972 c -6.135,35.00247 0.555,56.72247 12.929996,99.74994 18.00748,62.65496 -32.684996,78.93745 -32.684996,78.93745 0,0 121.244936,24.08249 153.307416,27.74999 C 345.17652,415.6246 423.19898,336.20713 433.99146,255.32719 446.62147,160.71474 381.499,78.124788 290.54656,62.1723 Z',
	'path-end' => 'M 263.80094,57.290063 C 172.841,41.345073 85.053557,96.860043 68.568561,190.88748 c -6.135,35.00247 -8.239363,52.86501 0.929996,99.74994 13.234691,67.73822 33.315003,138.93745 33.315003,138.93745 0,0 67.24494,-35.91751 99.30742,-32.25001 C 318.4309,410.74236 396.45336,331.32489 407.24584,250.44495 419.87585,155.8325 354.75338,73.242551 263.80094,57.290063 Z',
	'path-duration' 	=> '3500',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeOutElastic',
	'path-elasticity' 	=> '500',
	'path-scaleX' 		=> $path_def['scaleX'],
	'path-scaleY' 		=> $path_def['scaleY'],
	'path-translateX' 	=> '20',
	'path-translateY' 	=> '15',
	'path-rotate'		=> $path_def['rotate'],
	'image-duration' 	=> '1000',
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeOutQuint',
	'image-elasticity' 	=> '600',
	'image-scaleX' 		=> '0.8',
	'image-scaleY' 		=> '0.8',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '10',
	'image-rotate'		=> '20'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 435.78681,265.32748 C 453.50347,164.26087 391.82018,66.719269 287.34523,48.402608 248.4536,41.585939 224.32027,49.019268 176.51196,62.769269 106.89533,82.777573 88.803675,26.452608 88.803675,26.452608 c 0,0 -26.75833,134.716592 -30.83333,170.341572 -14.90833,129.23325 73.333325,215.92488 163.199925,227.91652 105.12494,14.03334 196.89155,-58.32496 214.61654,-159.38322 z',
	'deco-duration' 	=> '1300',
	'deco-delay' 		=> '0',
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> '300',
	'deco-scaleX' 		=> '0.9',
	'deco-scaleY' 		=> '0.9',
	'deco-translateX' 	=> '20',
	'deco-translateY' 	=> '10',
	'deco-rotate' 		=> '-75'
];

// Language cloud 4
	
$foreground_shapes_array[] = [ 
	'path-start' => 'M 424.96404,266.56453 C 440.90903,175.60459 385.39406,81.817158 291.36662,65.332153 c -35.00247,-6.135 -56.72247,-5.445 -99.74994,6.930005 -62.65496,18.007472 -78.93745,-20.685005 -78.93745,-20.685005 0,0 -24.082495,121.244937 -27.749995,153.307417 -13.4175,116.30992 65.999975,194.33238 146.879915,205.12486 94.61245,12.63001 177.2024,-52.49246 193.15489,-143.4449 z',
	'path-end' => 'M 444.96404,266.56453 C 457.96774,175.13774 387.39406,71.817158 293.36662,55.332153 c -35.00247,-6.135 -58.72247,-9.445 -101.74994,2.930005 -62.65496,18.007472 -78.93745,-6.685005 -78.93745,-6.685005 0,0 -34.413702,121.208787 -37.749995,153.307417 -15.536144,148.08958 75.999975,214.33238 156.879915,225.12486 94.61245,12.63001 195.08376,-36.47551 213.15489,-163.4449 z',
	'path-duration' 	=> '2000',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutQuint',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1',
	'path-scaleY' 		=> '1',
	'path-translateX' 	=> $path_def['translateX'],
	'path-translateY' 	=> $path_def['translateY'],
	'path-rotate'		=> '-30',
	'image-easing' 		=> 'easeOutElastic',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-duration' 	=> '1000',
	'image-delay' 		=> $image_def['delay'],
	'image-scaleX' 		=> $image_def['scaleX'],
	'image-scaleY' 		=> $image_def['scaleY'],
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '30',
	'image-rotate'		=> '-60'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'm 417.66764,122.60111 c 35.4998,88.51738 37.37538,227.08554 -39.59848,283.42363 C 295.22892,466.66577 133.05023,438.74345 74.421836,354.46182 31.268508,292.3847 30.412445,140.21353 130.60244,151.53244 c 100.19,11.40733 111.76057,-102.787749 194.07332,-102.504209 39.50577,0.126551 78.28615,36.874869 92.99188,73.572879 z',
	'deco-duration' 	=> '2000',
	'deco-delay' 		=> $background_shape_def['delay'],
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '0.9',
	'deco-scaleY' 		=> '0.9',
	'deco-translateX' 	=> $background_shape_def['translateX'],
	'deco-translateY' 	=> '20',
	'deco-rotate' 		=> '-30'
];

// Language cloud 5
	
$foreground_shapes_array[] = [ 
	'path-start' => 'm 220.5718,62.1723 c 90.95994,-15.94499 178.74738,39.56998 195.23238,133.59742 6.135,35.00247 -0.555,56.72247 -12.93,99.74994 -18.00748,62.65496 32.685,78.93745 32.685,78.93745 0,0 -121.24494,24.08249 -153.30742,27.74999 C 165.94184,415.6246 87.91938,336.20713 77.1269,255.32719 64.496897,160.71474 129.61936,78.124788 220.5718,62.1723 Z',
	'path-end' => 'm 216.5718,56.1723 c 90.95994,-15.94499 178.74738,39.56998 195.23238,133.59742 6.135,35.00247 7.445,60.72247 -4.93,103.74994 -18.00748,62.65496 -105.315,156.93745 -105.315,156.93745 0,0 -7.24494,-59.91751 -39.30742,-56.25001 C 145.94184,407.6246 83.91938,330.20713 73.1269,249.32719 60.496897,154.71474 125.61936,72.12479 216.5718,56.1723 Z',
	'path-duration' 	=> '2000',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutQuint',
	'path-elasticity' 	=> '800',
	'path-scaleX' 		=> '0.9',
	'path-scaleY' 		=> '0.9',
	'path-translateX' 	=> '0',
	'path-translateY' 	=> '5',
	'path-rotate'		=> '60',
	'image-easing' 		=> 'easeOutExpo',
	'image-elasticity' 	=> '300',
	'image-duration' 	=> '1000',
	'image-delay' 		=> $image_def['delay'],
	'image-scaleX' 		=> '0.8',
	'image-scaleY' 		=> '0.8',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '0',
	'image-rotate'		=> $image_def['rotate']
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 286.3778,428.52934 C 180.25786,447.13183 77.839179,382.36437 58.606685,272.66568 51.449182,231.82947 59.254178,206.48947 73.691679,156.29075 94.700399,83.19329 35.559185,64.197049 35.559185,64.197049 c 0,0 141.452425,-28.096239 178.858655,-32.374989 135.69491,-15.653751 226.72112,76.99998 239.31234,171.35991 14.73501,110.38119 -61.24121,206.73613 -167.35238,225.34737 z',
	'deco-duration' 	=> '1200',
	'deco-delay' 		=> '1000',
	'deco-easing' 		=> 'easeOutElastic',
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '0.85',
	'deco-scaleY' 		=> '0.85',
	'deco-translateX' 	=> '-5',
	'deco-translateY' 	=> '-3',
	'deco-rotate' 		=> '60'
];

// Organic cloud 6

$foreground_shapes_array[] = [ 
	'path-start' => 'M 97.669577,390.57122 C 138.14414,416.7801 150.59121,342.41477 257.74761,359.01216 413.59251,385.34724 471.3152,331.80366 466.72721,267.61973 462.34699,206.3422 375.72138,43.061192 208.10497,86.245819 67.59381,122.44705 -8.625995,321.74066 97.669577,390.57122 Z',
	'path-end' => 'M 67.632558,280.84966 C 70.066563,337.18605 137.808,382.94361 193.01912,394.40858 280.12946,412.49765 418.81676,393.58647 445.8294,308.8177 476.37944,212.94817 369.0676,70.531661 268.63265,64.441437 170.36206,58.482459 63.382957,182.49033 67.632558,280.84966 Z',
	'path-duration' 	=> '1500',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutQuart',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1.1',
	'path-scaleY' 		=> '1.1',
	'path-translateX' 	=> '-20',
	'path-translateY' 	=> '20',
	'path-rotate'		=> '20',
	'image-duration' 	=> '2500',
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeOutCubic',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> $image_def['scaleX'],
	'image-scaleY' 		=> $image_def['scaleY'],
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> $image_def['translateY'],
	'image-rotate'		=> '-30'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'm 100.82372,231.10236 c 15.95331,-60.50742 28.88561,-126.17903 82.87169,-149.888915 83.99355,-36.88008 141.95826,54.834695 207.52236,125.776565 45.75261,49.49563 82.77212,122.53046 -52.78478,171.34851 C 223.36539,419.82258 138.5774,460.71563 94.292268,412.32431 56.038189,370.51972 76.107769,324.82927 100.82372,231.10236 Z',
	'deco-duration' 	=> '1500',
	'deco-delay' 		=> '500',
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> $background_shape_def['scaleX'],
	'deco-scaleY' 		=> $background_shape_def['scaleY'],
	'deco-translateX' 	=> '35',
	'deco-translateY' 	=> '35',
	'deco-rotate' 		=> '-75'
];

// Organic cloud 7

$foreground_shapes_array[] = [ 
	'path-start' => 'M 225.72192,75 C 86.630916,75 53.818851,163.40428 50.240601,262.96791 45.025178,408.39572 124.86428,445 263.95528,445 403.04628,445 461.98448,382.6738 412.96735,246.14973 379.3318,152.47246 364.81292,75 225.72192,75 Z',
	'path-end' => 'M 225.72192,75 C 31.671589,-28.464177 53.81885,263.40428 50.2406,362.96791 45.02518,508.39572 124.86428,395 263.95528,395 403.04628,395 478.93363,382.6738 412.96735,246.14973 369.66293,156.53104 330.15687,130.68285 225.72192,75 Z',
	'path-duration' 	=> '1500',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutQuart',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1',
	'path-scaleY' 		=> '1',
	'path-translateX' 	=> $path_def['translateX'],
	'path-translateY' 	=> $path_def['translateY'],
	'path-rotate'		=> '-15',
	'image-duration' 	=> '2300',
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeInOutQuart',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.4',
	'image-scaleY' 		=> '1.4',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '-60',
	'image-rotate'		=> $image_def['rotate']
];

$background_shapes_array[] = [
	'deco-path' 		=>  'm 162.27141,81.557191 c -141.879997,0 -102.139997,202.920009 -105.789997,303.560009 -5.32,147 83.119997,13 224.999997,13 141.88,0 237,79 187,-59 -34.31,-94.69 -164.33,-257.560009 -306.21,-257.560009 z',
	'deco-duration' 	=> '1500',
	'deco-delay' 		=> '0',
	'deco-easing' 		=> 'easeInOutQuart',
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> $background_shape_def['scaleX'],
	'deco-scaleY' 		=> $background_shape_def['scaleY'],
	'deco-translateX' 	=> '-10',
	'deco-translateY' 	=> '20',
	'deco-rotate' 		=> '-15'
];

// Organic cloud 8

$foreground_shapes_array[] = [ 
	'path-start' => 'm 442.47634,210.55411 c 0,-124.559998 -124.88,-155.139998 -200.56,-155.139998 -75.68001,0 -172.790004,64.579998 -162.720004,188.649998 10.73,132.33 135.000004,172.62 210.110004,163.2 89.41,-11.2 153.17,-72.18 153.17,-196.71 z',
	'path-end' => 'm 430.89449,123.69557 c -49.50365,-114.26771 -130.41932,-1.49085 -205,-18.44 -73.75927,-16.762481 -193.412547,-69.134746 -171.680005,110.07 15.966934,131.80068 139.500005,239.44 214.590005,230 89.41,-11.18 194.92898,-245.82881 162.09,-321.63 z',
	'path-duration' 	=> $path_def['duration'],
	'path-delay' 		=> '300',
	'path-easing' 		=> $path_def['easing'],
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1.1',
	'path-scaleY' 		=> '1.1',
	'path-translateX' 	=> '-10',
	'path-translateY' 	=> '0',
	'path-rotate'		=> '30',
	'image-duration' 	=> $path_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> $image_def['easing'],
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> $image_def['translateY'],
	'image-rotate'		=> '30'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 48.193385,226.25593 C 64.331173,156.93586 160.4152,135.85233 224.49951,104.22706 275.53354,79.033315 342.37645,16.517482 387.0445,51.61409 c 41.80332,32.881775 1.69759,109.26162 22.17486,158.03057 19.31016,45.89393 74.16379,46.1069 79.3627,95.51475 6.89648,64.63483 -56.12683,160.5755 -121.27215,153.22822 -66.3124,-7.56026 -25.35787,-134.80676 -84.87988,-165.04778 -56.02072,-28.43081 -128.59302,46.21338 -185.547421,19.69926 -30.238458,-14.05569 -56.201093,-54.519 -48.689224,-86.78318 z',
	'deco-duration' 	=> '3000',
	'deco-delay' 		=> $background_shape_def['delay'],
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> $background_shape_def['scaleX'],
	'deco-scaleY' 		=> $background_shape_def['scaleY'],
	'deco-translateX' 	=> '-40',
	'deco-translateY' 	=> '20',
	'deco-rotate' 		=> '30'
];

// Star 9

$foreground_shapes_array[] = [ 
	'path-start' => 'm 70.567638,433.09926 c 15.21,65.1 123.769992,-95.1 184.169992,-65.4 48.1,23.66001 101.1,118.37 143.2,85.41001 39.39998,-30.88 -50.4,-124.61001 -31.10002,-170.41001 18.2,-43.1 111.60089,-92.18095 83.73003,-129.6 -19.8191,-26.69034 -70.44894,16.55539 -120.46175,10.03737 -39.5128,-5.14959 7.29248,-129.458933 -59.53825,-130.037373 -47.47192,-0.3536 -31.47881,129.758903 -79.57898,121.787683 -53.45585,-8.85876 -128.994152,-65.914113 -140.421022,-41.78768 -23.98032,50.57353 81.197112,123.58305 69.890002,184.5 -5.74982,30.87765 -56.970012,105.2 -49.890002,135.5 z',
	'path-end' => 'm 70.567638,433.09926 c 15.21,65.1 116.879832,-26.91123 184.169992,-25.4 52.59432,1.1884 101.1,78.37 143.2,45.41001 39.39998,-30.88 7.57729,-118.61758 8.89998,-170.41001 1.22924,-46.769 71.60089,-92.18095 43.73003,-129.6 -19.8191,-26.69034 -56.44137,-3.96921 -100.46175,-29.96263 -34.31165,-20.26055 -12.70752,-89.458933 -79.53825,-90.037373 -47.47192,-0.3536 -34.47503,30.808106 -79.57898,61.787683 -44.66423,30.67755 -128.994152,-5.914113 -140.421022,18.21232 -23.98032,50.57353 47.046191,122.60785 49.890002,184.5 1.74072,38.36819 -36.970012,105.2 -29.890002,135.5 z',
	'path-duration' 	=> $path_def['duration'],
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeOutElastic',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1.05',
	'path-scaleY' 		=> '1.05',
	'path-translateX' 	=> '0',
	'path-translateY' 	=> '0',
	'path-rotate'		=> '-10',
	'image-duration' 	=> $path_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeOutElastic',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.4',
	'image-scaleY' 		=> '1.4',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> $image_def['translateY'],
	'image-rotate'		=> '30'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 82.660965,423.25488 C 96.708,483.37728 190.60407,398.4013 252.74916,399.79698 c 48.57292,1.09754 93.36981,72.37777 132.25081,41.93792 36.38742,-28.51888 6.99792,-109.54797 8.21948,-157.38031 1.13525,-43.193 66.12622,-85.13272 40.38639,-119.69067 -18.30371,-24.64958 -52.12581,-3.66573 -92.78036,-27.67167 -31.68815,-18.71141 -11.73589,-82.618823 -73.45668,-83.153035 -43.84218,-0.326563 -31.83904,28.452492 -73.49431,57.063345 -41.24916,28.33192 -116.134931,3.52673 -129.684308,16.81979 -36.914643,36.18422 43.448998,113.23315 46.075368,170.39297 1.60763,35.43453 -34.143252,97.15632 -27.604585,125.13956 z',
	'deco-duration' 	=> '2000',
	'deco-delay' 		=> '100',
	'deco-easing' 		=> 'easeOutElastic',
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '1.05',
	'deco-scaleY' 		=> '1.05',
	'deco-translateX' 	=> '0',
	'deco-translateY' 	=> '0',
	'deco-rotate' 		=> '20'
];

// Organic star 10

$foreground_shapes_array[] = [ 
	'path-start' => 'm 70.571977,433.09926 c 15.21,65.1 123.769993,-95.1 184.169993,-65.4 48.1,23.66001 101.1,118.37 143.2,85.41001 39.39998,-30.88 -50.4,-124.61001 -31.10002,-170.41001 18.2,-43.1 111.60089,-92.18095 83.73003,-129.6 -19.8191,-26.69034 -70.44894,16.55539 -120.46175,10.03737 C 290.59743,157.98704 337.40271,33.677697 270.57198,33.099257 223.10006,32.745657 239.09317,162.85816 190.993,154.88694 137.53715,146.02818 61.998846,88.972825 50.571977,113.09926 c -23.980315,50.57353 81.197113,123.58305 69.890003,184.5 -5.74982,30.87765 -56.970005,105.2 -49.890003,135.5 z',
	'path-end' => 'm 96.571977,373.09926 c 14.733563,63.73042 107.489513,81.20406 158.169993,80.6 35.42278,-0.41735 79.08078,-6.09571 103.2,-40.58999 29.16761,-41.76159 10.4912,-80.16249 12.89998,-106.41001 2.38251,-25.75094 20.38748,-65.94227 19.73003,-113.6 -0.50605,-41.0396 -13.69881,-73.17316 -29.877,-94.55585 C 343.3684,75.642885 328.47376,55.770219 270.57198,33.099259 226.34558,15.844294 156.09695,11.397901 110.993,34.88694 62.934495,59.914637 50.336114,107.17521 50.571977,133.09926 c 0.465806,53.82005 50.710363,85.08116 49.890003,144.5 -0.45174,31.40518 -10.899422,65.18357 -3.890003,95.5 z',
	'path-duration' 	=> '2500',
	'path-delay' 		=> '300',
	'path-easing' 		=> 'easeOutElastic',
	'path-elasticity' 	=> '400',
	'path-scaleX' 		=> '0.95',
	'path-scaleY' 		=> '1.0',
	'path-translateX' 	=> '0',
	'path-translateY' 	=> '30',
	'path-rotate'		=> '30',
	'image-duration' 	=> $path_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> $image_def['easing'],
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> $image_def['translateY'],
	'image-rotate'		=> '60'
];

$background_shapes_array[] = [
	'deco-path' 		=>  'm 80,431.72808 c 15.21,65.1 123.76999,-75.1 184.16999,-45.4 48.1,23.66001 101.1,98.37 143.2,65.41001 39.39998,-30.88 -50.4,-124.61001 -31.10002,-170.41001 18.2,-43.1 111.60089,-152.18095 83.73003,-189.6 C 440.1809,65.03774 389.55106,168.28347 339.53825,161.76545 300.02545,156.61586 346.83073,32.30652 280,31.72808 232.52808,31.37448 248.52119,161.48698 200.42102,153.51576 146.96517,144.657 63.936331,86.10354 60,111.72808 c -8.52284,55.31816 81.19711,123.58305 69.89,184.5 -5.74982,30.87765 -56.970002,105.2 -49.89,135.5 z',
	'deco-duration' 	=> '3000',
	'deco-delay' 		=> $background_shape_def['delay'],
	'deco-easing' 		=> 'easeOutElastic',
	'deco-elasticity' 	=> '600',
	'deco-scaleX' 		=> $background_shape_def['scaleX'],
	'deco-scaleY' 		=> $background_shape_def['scaleY'],
	'deco-translateX' 	=> '-20',
	'deco-translateY' 	=> '0',
	'deco-rotate' 		=> '-15'
];

// Rotating fat bean 11

$foreground_shapes_array[] = [ 
	'path-start' => 'M 174.97,61.21256 C 98.007502,86.689796 29.429107,190.26065 48.620077,269.02627 c 6.746146,27.68825 51.402893,25.88827 73.040613,44.43439 48.72155,41.76021 59.88283,148.79229 124.03303,147.22485 C 364.38199,457.78549 492.94409,291.92403 461.59793,177.41319 434.37802,77.975972 272.84228,28.813467 174.97,61.21256 Z',
	'path-end' => 'M 174.97,61.21256 C 98.325567,87.631239 56.474886,188.33787 48.620077,269.02627 c -3.822796,39.26961 12.290916,83.85752 40.8313,111.10018 49.542243,47.28956 132.304483,87.15026 195.942193,61.83272 C 384.73893,402.43573 478.15198,262.07701 441.37348,161.68306 408.727,72.568275 264.69577,30.284855 174.97,61.21256 Z',
	'path-duration' 	=> '1700',
	'path-delay' 		=> $path_def['delay'],
	'path-easing' 		=> 'easeInOutBack',
	'path-elasticity' 	=> $path_def['elasticity'],
	'path-scaleX' 		=> '1',
	'path-scaleY' 		=> '1',
	'path-translateX' 	=> $path_def['translateX'],
	'path-translateY'	=> '-20',
	'path-rotate'		=> $path_def['rotate'],
	'image-duration' 	=> $image_def['duration'],
	'image-delay' 		=> $image_def['delay'],
	'image-easing' 		=> 'easeInOutQuart',
	'image-elasticity' 	=> $image_def['elasticity'],
	'image-scaleX' 		=> '1.3',
	'image-scaleY' 		=> '1.3',
	'image-translateX' 	=> $image_def['translateX'],
	'image-translateY'	=> '40',
	'image-rotate'		=> $image_def['rotate']
];

$background_shapes_array[] = [
	'deco-path' 		=>  'M 311.11885,443.38994 C 398.5941,388.32207 496.55772,245.97207 441.53041,158.52239 386.5031,71.072708 169.62055,24.543084 82.15985,79.572899 -5.3008629,134.60271 17.145777,250.15909 72.175578,337.61978 127.20541,425.08053 223.67166,498.42827 311.11885,443.38994 Z',
	'deco-duration' 	=> '1500',
	'deco-delay' 		=> '500',
	'deco-easing' 		=> $background_shape_def['easing'],
	'deco-elasticity' 	=> $background_shape_def['elasticity'],
	'deco-scaleX' 		=> '1.1',
	'deco-scaleY' 		=> '1',
	'deco-translateX' 	=> $background_shape_def['translateX'],
	'deco-translateY' 	=> '-20',
	'deco-rotate' 		=> '20'
];