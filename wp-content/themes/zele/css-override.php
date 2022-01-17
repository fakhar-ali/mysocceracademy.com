<?php
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars ) ) {
	$boldthemes_crush_vars = apply_filters( 'boldthemes_crush_vars', BoldThemesFramework::$crush_vars );
}
if ( class_exists( 'BoldThemesFramework' ) && isset( BoldThemesFramework::$crush_vars_def ) ) {
	$boldthemes_crush_vars_def = BoldThemesFramework::$crush_vars_def;
}
if ( isset( $boldthemes_crush_vars['accentColor'] ) ) {
	$accentColor = $boldthemes_crush_vars['accentColor'];
} else {
	$accentColor = "#fe5000";
}
if ( isset( $boldthemes_crush_vars['alternateColor'] ) ) {
	$alternateColor = $boldthemes_crush_vars['alternateColor'];
} else {
	$alternateColor = "#171c34";
}
if ( isset( $boldthemes_crush_vars['bodyFont'] ) ) {
	$bodyFont = $boldthemes_crush_vars['bodyFont'];
} else {
	$bodyFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['menuFont'] ) ) {
	$menuFont = $boldthemes_crush_vars['menuFont'];
} else {
	$menuFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['headingFont'] ) ) {
	$headingFont = $boldthemes_crush_vars['headingFont'];
} else {
	$headingFont = "Anton";
}
if ( isset( $boldthemes_crush_vars['headingSuperTitleFont'] ) ) {
	$headingSuperTitleFont = $boldthemes_crush_vars['headingSuperTitleFont'];
} else {
	$headingSuperTitleFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['headingSubTitleFont'] ) ) {
	$headingSubTitleFont = $boldthemes_crush_vars['headingSubTitleFont'];
} else {
	$headingSubTitleFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['buttonFont'] ) ) {
	$buttonFont = $boldthemes_crush_vars['buttonFont'];
} else {
	$buttonFont = "Roboto";
}
if ( isset( $boldthemes_crush_vars['logoHeight'] ) ) {
	$logoHeight = $boldthemes_crush_vars['logoHeight'];
} else {
	$logoHeight = "90";
}
if ( isset( $boldthemes_crush_vars['crestWidth'] ) ) {
	$crestWidth = $boldthemes_crush_vars['crestWidth'];
} else {
	$crestWidth = "130";
}
if ( isset( $boldthemes_crush_vars['stickyLogoHeight'] ) ) {
	$stickyLogoHeight = $boldthemes_crush_vars['stickyLogoHeight'];
} else {
	$stickyLogoHeight = "55";
}
$accentColorDark = CssCrush\fn__l_adjust( $accentColor." -15" );$accentColorVeryDark = CssCrush\fn__l_adjust( $accentColor." -35" );$accentColorVeryVeryDark = CssCrush\fn__l_adjust( $accentColor." -42" );$accentColorLight = CssCrush\fn__a_adjust( $accentColor." -30" );$alternateColorDark = CssCrush\fn__l_adjust( $alternateColor." -15" );$alternateColorVeryDark = CssCrush\fn__l_adjust( $alternateColor." -25" );$alternateColorLight = CssCrush\fn__a_adjust( $alternateColor." -40" );$css_override = sanitize_text_field(".bt_bb_dash_top.bt_bb_headline .bt_bb_headline_superheadline:before,
.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_superheadline:before{background: {$accentColor};}
select,
input{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.fancy-select ul.options li:hover{color: {$accentColor};}
input:not([type='checkbox']):not([type='radio']):not([type='submit']):focus,
textarea:focus,
.fancy-select .trigger.open{border-color: {$accentColor};}
.bt-content a{color: {$accentColor};}
a:hover{
    color: {$accentColor};}
.btText a{color: {$accentColor};}
body{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
h1,
h2,
h3,
h4,
h5,
h6{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
blockquote{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt-content-holder table td.product-name{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btAccentDarkHeader .btPreloader .animation > div:first-child,
.btLightAccentHeader .btPreloader .animation > div:first-child,
.btTransparentLightHeader .btPreloader .animation > div:first-child{
    background-color: {$accentColor};}
.btPreloader .animation .preloaderLogo{height: {$logoHeight}px;}
body.error404 .bt-error-page .port .bt_bb_button.bt_bb_style_filled a:before{background-color: {$accentColor};}
.btPageHeadline{background-color: {$alternateColor};}
.bt-no-search-results .bt_bb_port #searchform input[type='submit']{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.bt-no-search-results .bt_bb_port #searchform input[type='submit']:hover{
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset;
    box-shadow: 0 0 0 0 {$accentColor} inset;
    color: {$accentColor};}
body:not(.bt_bb_plugin_active) .bt-no-search-results .bt_bb_port .bt_bb_button.bt_bb_style_filled a:before{background-color: {$accentColor};}
body:not(.bt_bb_plugin_active) .bt-no-search-results .bt_bb_port .bt_bb_button.bt_bb_style_filled a:hover{color: {$accentColor};}
.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .logo{
    padding-left: {$crestWidth}px;}
.rtl.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .logo{
    padding-right: {$crestWidth}px;}
.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .btTopToolsLeft{margin-left: {$crestWidth}px;}
.rtl.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .btTopToolsLeft{margin-right: {$crestWidth}px;}
.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .btBelowLogoArea .menuPort{margin-left: {$crestWidth}px;}
.rtl.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .btBelowLogoArea .menuPort{margin-right: {$crestWidth}px;}
.btHasCrest.btMenuHorizontal:not(.btMenuCenter):not(.btStickyHeaderActive) .btCrest .btCrestImg{width: {$crestWidth}px;}
.btHasCrest.btMenuHorizontal.btMenuLeft.btNoLogo:not(.btStickyHeaderActive) .menuPort{margin-left: {$crestWidth}px;}
.rtl.btHasCrest.btMenuHorizontal.btMenuLeft.btNoLogo:not(.btStickyHeaderActive) .menuPort{margin-right: {$crestWidth}px;}
.btHasCrest.btMenuHorizontal.btMenuCenter.btNoLogo:not(.btStickyHeaderActive) .menuPort .rightNav{padding-left: {$crestWidth}px;}
.mainHeader{font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.mainHeader a:hover{color: {$accentColor};}
.menuPort{
    font-family: \"{$menuFont}\",Arial,Helvetica,sans-serif;}
.menuPort nav ul li a:hover{color: {$accentColor};}
.menuPort nav > ul > li > a{line-height: {$logoHeight}px;}
.btTextLogo{
    line-height: {$logoHeight}px;
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt-logo-area .logo img{height: {$logoHeight}px;}
.btTransparentLightHeader .bt-horizontal-menu-trigger .bt_bb_icon:before,
.btTransparentLightHeader .bt-horizontal-menu-trigger .bt_bb_icon:after{border-top-color: {$accentColor};}
.btTransparentLightHeader .bt-horizontal-menu-trigger .bt_bb_icon .bt_bb_icon_holder:before{border-top-color: {$accentColor};}
.btTransparentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btDarkTransparentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btAccentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btAccentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btLightDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btHasAltLogo.btStickyHeaderActive .bt-horizontal-menu-trigger:hover .bt_bb_icon:before,
.btTransparentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:after,
.btDarkTransparentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:after,
.btAccentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:after,
.btAccentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:after,
.btLightDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon:after,
.btHasAltLogo.btStickyHeaderActive .bt-horizontal-menu-trigger:hover .bt_bb_icon:after{border-top-color: {$accentColor};}
.btTransparentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btTransparentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btDarkTransparentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentTransparentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentLightHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btLightDarkHeader .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btHasAltLogo.btStickyHeaderActive .bt-horizontal-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before{border-top-color: {$accentColor};}
.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor li.current-menu-ancestor > a,
.btMenuHorizontal .menuPort nav > ul > li.current-menu-ancestor li.current-menu-item > a,
.btMenuHorizontal .menuPort nav > ul > li.current-menu-item li.current-menu-ancestor > a,
.btMenuHorizontal .menuPort nav > ul > li.current-menu-item li.current-menu-item > a{color: {$accentColor};}
.btMenuHorizontal .menuPort nav > ul > li:not(.btMenuWideDropdown) > ul > li.menu-item-has-children > a:before{
    background-color: {$accentColor};}
.btMenuHorizontal .menuPort ul ul li a:hover{color: {$accentColor};}
body.btMenuHorizontal .subToggler{
    line-height: {$logoHeight}px;}
.btMenuHorizontal .menuPort > nav > ul > li > a:after{
    background-color: {$accentColor};}
.btMenuHorizontal .menuPort > nav > ul > li > ul li a:hover{-webkit-box-shadow: inset 0 0 0 0 {$accentColor};
    box-shadow: inset 0 0 0 0 {$accentColor};}
html:not(.touch) body.btMenuHorizontal.btMenuRight .menuPort > nav > ul > li.btMenuWideDropdown > ul > li > a{color: {$accentColor};}
html:not(.touch) body.btMenuHorizontal.btMenuRight .menuPort > nav > ul > li.btMenuWideDropdown > ul > li > a:after{
    background-color: {$accentColor};}
html:not(.touch) body.btMenuHorizontal.btMenuRight .menuPort > nav > ul > li.btMenuWideDropdown > ul > li:last-child > a:after{
    background-color: {$accentColor};}
.btMenuHorizontal .topBarInMenu{
    height: {$logoHeight}px;}
.btSpecialTransparentLightHeader.btMenuHorizontal .menuPort ul ul li a:hover{color: {$accentColor};}
.btSpecialTransparentLightHeader.btMenuHorizontal.btHasAltLogo.btStickyHeaderActive .mainHeader .menuPort ul ul li a:hover{color: {$accentColor};}
.btSpecialTransparentLightHeader.btMenuHorizontal.btHasAltLogo.btStickyHeaderActive .mainHeader .menuPort nav > ul > li.current-menu-ancestor li.current-menu-ancestor > a,
.btSpecialTransparentLightHeader.btMenuHorizontal.btHasAltLogo.btStickyHeaderActive .mainHeader .menuPort nav > ul > li.current-menu-ancestor li.current-menu-item > a,
.btSpecialTransparentLightHeader.btMenuHorizontal.btHasAltLogo.btStickyHeaderActive .mainHeader .menuPort nav > ul > li.current-menu-item li.current-menu-ancestor > a,
.btSpecialTransparentLightHeader.btMenuHorizontal.btHasAltLogo.btStickyHeaderActive .mainHeader .menuPort nav > ul > li.current-menu-item li.current-menu-item > a{color: {$accentColor};}
.btStickyHeaderActive.btAccentTransparentLightHeader .mainHeader{background-color: {$accentColor};}
.btMenuVertical.btAccentTransparentLightHeader .mainHeader{background-color: {$accentColor};}
.btMenuVertical.btAccentTransparentLightHeader .mainHeader a:hover{color: {$alternateColor};}
.btStickyHeaderActive.btAccentTransparentLightHeader .bt-vertical-header-top{background-color: {$accentColor};}
.btAccentTransparentLightHeader .topBar{
    background-color: {$accentColor};}
.btAccentTransparentLightHeader .topBar a.btAccentIconWidget.btIconWidget .btIconWidgetIcon,
.btAccentTransparentLightHeader .topBar a.btAccentIconWidget.btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText,
.btAccentTransparentLightHeader .topBar a.btIconWidget:hover{color: {$alternateColor};}
.btAccentLightHeader .bt-below-logo-area,
.btAccentLightHeader .topBar{background-color: {$accentColor};}
.btAccentLightHeader .bt-below-logo-area a:hover,
.btAccentLightHeader .topBar a:hover{color: {$alternateColor};}
.btAccentLightHeader .bt-below-logo-area .btAccentIconWidget.btIconWidget .btIconWidgetIcon,
.btAccentLightHeader .bt-below-logo-area .btAccentIconWidget.btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText,
.btAccentLightHeader .bt-below-logo-area .btIconWidget:hover,
.btAccentLightHeader .topBar .btAccentIconWidget.btIconWidget .btIconWidgetIcon,
.btAccentLightHeader .topBar .btAccentIconWidget.btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText,
.btAccentLightHeader .topBar .btIconWidget:hover{color: {$alternateColor};}
.btAccentLightHeader.btMenuHorizontal .menuPort nav > ul > li > a:after{background: {$alternateColor};}
.btAccentDarkHeader .bt-below-logo-area,
.btAccentDarkHeader .topBar{background-color: {$accentColor};}
.btAccentDarkHeader .bt-below-logo-area a:hover,
.btAccentDarkHeader .topBar a:hover{color: {$alternateColor};}
.btAccentDarkHeader .bt-below-logo-area .btAccentIconWidget.btIconWidget .btIconWidgetIcon,
.btAccentDarkHeader .bt-below-logo-area .btAccentIconWidget.btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText,
.btAccentDarkHeader .bt-below-logo-area .btIconWidget:not(.btCartWidget):hover,
.btAccentDarkHeader .topBar .btAccentIconWidget.btIconWidget .btIconWidgetIcon,
.btAccentDarkHeader .topBar .btAccentIconWidget.btIconWidget.btWidgetWithText .btIconWidgetContent .btIconWidgetText,
.btAccentDarkHeader .topBar .btIconWidget:not(.btCartWidget):hover{color: {$alternateColor};}
.btAccentDarkHeader .topBarInMenu .btIconWidget .btIconWidgetContent .btIconWidgetText{color: {$alternateColor};}
.btAccentDarkHeader .topBarInMenu .btIconWidget.btAccentIconWidget .btIconWidgetContent .btIconWidgetText{color: {$accentColor};}
.btAccentDarkHeader.btMenuHorizontal .menuPort nav > ul > li > a:after{background: {$alternateColor};}
.btLightAccentHeader .menuPort nav ul li a:hover{color: {$alternateColor};}
.btLightAccentHeader.btMenuHorizontal .menuPort nav > ul > li > a:after{background: {$alternateColor};}
.btLightAccentHeader .bt-logo-area,
.btLightAccentHeader .bt-vertical-header-top{
    background-color: {$accentColor};}
.btLightAccentHeader .topBarInMenu .btIconWidget .btIconWidgetContent .btIconWidgetText{color: {$alternateColor};}
.btLightAccentHeader.btMenuHorizontal.btBelowMenu .mainHeader{background-color: {$accentColor};}
.btLightAccentHeader.btMenuHorizontal.btBelowMenu .mainHeader .bt-logo-area{background-color: {$accentColor};}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .logo img,
.btStickyHeaderActive.btMenuFullScreenCenter .mainHeader .bt-logo-area .logo img{height: {$stickyLogoHeight}px;}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .btTextLogo,
.btStickyHeaderActive.btMenuFullScreenCenter .mainHeader .bt-logo-area .btTextLogo{
    line-height: {$stickyLogoHeight}px;}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .menuPort nav > ul > li > a,
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .menuPort nav > ul > li > .subToggler,
.btStickyHeaderActive.btMenuFullScreenCenter .mainHeader .bt-logo-area .menuPort nav > ul > li > a,
.btStickyHeaderActive.btMenuFullScreenCenter .mainHeader .bt-logo-area .menuPort nav > ul > li > .subToggler{line-height: {$stickyLogoHeight}px;}
.btStickyHeaderActive.btMenuHorizontal .mainHeader .bt-logo-area .topBarInMenu,
.btStickyHeaderActive.btMenuFullScreenCenter .mainHeader .bt-logo-area .topBarInMenu{height: {$stickyLogoHeight}px;}
.btTransparentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btTransparentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btAccentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btAccentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btLightDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btHasAltLogo.btStickyHeaderActive .bt-vertical-menu-trigger:hover .bt_bb_icon:before,
.btTransparentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:after,
.btTransparentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:after,
.btAccentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:after,
.btAccentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:after,
.btLightDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon:after,
.btHasAltLogo.btStickyHeaderActive .bt-vertical-menu-trigger:hover .bt_bb_icon:after{border-top-color: {$accentColor};}
.btTransparentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btTransparentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentLightHeader .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btLightDarkHeader .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btHasAltLogo.btStickyHeaderActive .bt-vertical-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before{border-top-color: {$accentColor};}
.btMenuVertical .mainHeader .btCloseVertical:before:hover{color: {$accentColor};}
.btMenuHorizontal .topBarInLogoArea{
    height: {$logoHeight}px;}
.btMenuHorizontal .topBarInLogoArea .topBarInLogoAreaCell{border: 0 solid {$accentColor};}
.btMenuVertical .mainHeader .btCloseVertical:hover:before{color: {$accentColor};}
.btTransparentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btTransparentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btAccentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btAccentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btLightDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btHasAltLogo.btStickyHeaderActive .bt-fullscreen-menu-trigger:hover .bt_bb_icon:before,
.btTransparentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after,
.btTransparentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after,
.btAccentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after,
.btAccentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after,
.btLightDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after,
.btHasAltLogo.btStickyHeaderActive .bt-fullscreen-menu-trigger:hover .bt_bb_icon:after{border-top-color: {$accentColor};}
.btTransparentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btTransparentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentLightHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btAccentDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btLightDarkHeader .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before,
.btHasAltLogo.btStickyHeaderActive .bt-fullscreen-menu-trigger:hover .bt_bb_icon .bt_bb_icon_holder:before{border-top-color: {$accentColor};}
.btMenuFullScreenCenter .topBarInLogoArea{height: {$logoHeight}px;}
.btAccentTransparentLightHeader .btMenuVerticalFullscreenEnabled .mainHeader .menuPort{
    background: {$accentColor} !important;}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled .mainHeader .menuPort{
    background: {$accentColor} !important;}
.btLightAccentHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:after,
.btAccentTransparentLightHeader.btMenuVerticalFullscreenEnabled.btMenuHorizontal .mainHeader .menuPort .header_fullscreen_image:after{background: {$accentColor};}
.btMenuVerticalFullscreenEnabled:not(.btMenuVertical) .mainHeader .menuPort{
    padding: {$logoHeight}px 30px;}
.btStickyHeaderActive.btMenuVerticalFullscreenEnabled:not(.btMenuVertical) .mainHeader .menuPort{top: {$stickyLogoHeight}px;
    height: -webkit-calc(100vh - {$stickyLogoHeight}px);
    height: -moz-calc(100vh - {$stickyLogoHeight}px);
    height: calc(100vh - {$stickyLogoHeight}px);}
html:not(.touch) body.btMenuVerticalFullscreenEnabled:not(.btMenuVertical) .mainHeader .menuPort > nav > ul > li.btMenuWideDropdown > ul > li.menu-item-has-children > a:before{
    background-color: {$accentColor};}
.bt_bb_back_to_top .bt_back_to_top_button{
    background: {$accentColor};}
.btDarkSkin .bt-site-footer-copy-menu .port:before,
.btLightSkin .btDarkSkin .bt-site-footer-copy-menu .port:before,
.btDarkSkin.btLightSkin .btDarkSkin .bt-site-footer-copy-menu .port:before{background-color: {$accentColor};}
.bt-content .btArticleHeadline .bt_bb_headline a:hover,
.bt-content .btArticleTextContent .bt_bb_headline a:hover{color: {$accentColor};}
.btPostSingleItemStandard .btArticleShareEtc > div.btReadMoreColumn .bt_bb_button a:hover{color: {$accentColor};}
.btMediaBox.btQuote:before,
.btMediaBox.btLink:before{
    background-color: {$accentColor};}
.sticky.btArticleListItem .btArticleHeadline h1 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h2 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h3 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h4 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h5 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h6 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h7 .bt_bb_headline_content span a:after,
.sticky.btArticleListItem .btArticleHeadline h8 .bt_bb_headline_content span a:after{
    color: {$accentColor};}
.post-password-form p:first-child{color: {$alternateColor};}
.post-password-form p:nth-child(2) input[type=\"submit\"]{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.btPagination{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btPagination .paging a:hover{color: {$accentColor};}
.btPagination .paging a:hover:after{color: {$accentColor};}
.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextTitle{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.btPrevNextNav .btPrevNext .btPrevNextItem .btPrevNextDir{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.btPrevNextNav .btPrevNext:hover .btPrevNextTitle{color: {$accentColor};}
.bt-link-pages ul a.post-page-numbers:hover{
    background: {$accentColor};}
.bt-link-pages ul span.post-page-numbers{
    background: {$accentColor};}
.btArticleCategories a:hover{color: {$accentColor};}
.btArticleCategories a:not(:first-child):before{
    background-color: {$accentColor};}
.btArticleAuthor a:hover{color: {$accentColor};}
.btArticleComments:hover{color: {$accentColor} !important;}
.bt-comments-box .vcard h1.author a:hover,
.bt-comments-box .vcard h2.author a:hover,
.bt-comments-box .vcard h3.author a:hover,
.bt-comments-box .vcard h4.author a:hover,
.bt-comments-box .vcard h5.author a:hover,
.bt-comments-box .vcard h6.author a:hover,
.bt-comments-box .vcard h7.author a:hover,
.bt-comments-box .vcard h8.author a:hover{color: {$accentColor};}
.bt-comments-box .commentTxt p.edit-link,
.bt-comments-box .commentTxt p.reply{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt-comments-box .comment-navigation a,
.bt-comments-box .comment-navigation span{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.comment-awaiting-moderation{color: {$accentColor};}
.comment-awaiting-moderation{color: {$accentColor};}
a#cancel-comment-reply-link{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    color: {$accentColor};}
a#cancel-comment-reply-link:hover{color: {$alternateColor};}
.bt-comment-submit .btnInnerText{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt-comment-submit:before{
    background: {$accentColor};}
body:not(.btNoDashInSidebar) .btBox > h4:after,
body:not(.btNoDashInSidebar) .widget_block > h4:after,
body:not(.btNoDashInSidebar) .btCustomMenu > h4:after,
body:not(.btNoDashInSidebar) .btTopBox > h4:after{
    border-bottom: 3px solid {$accentColor};}
.btBox ul li.current-menu-item > a,
.widget_block ul li.current-menu-item > a,
.btCustomMenu ul li.current-menu-item > a,
.btTopBox ul li.current-menu-item > a{color: {$accentColor};}
.btBox p.posted ins,
.btBox .quantity ins,
.widget_block p.posted ins,
.widget_block .quantity ins,
.btCustomMenu p.posted ins,
.btCustomMenu .quantity ins,
.btTopBox p.posted ins,
.btTopBox .quantity ins{
    color: {$accentColor};}
.btBox p.posted del + .amount,
.btBox .quantity del + .amount,
.widget_block p.posted del + .amount,
.widget_block .quantity del + .amount,
.btCustomMenu p.posted del + .amount,
.btCustomMenu .quantity del + .amount,
.btTopBox p.posted del + .amount,
.btTopBox .quantity del + .amount{color: {$accentColor};}
.widget_calendar table caption{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.widget_calendar table tbody tr td#today{color: {$accentColor};}
.widget_rss li a.rsswidget{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.widget_rss li .rss-date{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.widget_rss li cite{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.widget_shopping_cart .total{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.widget_shopping_cart .buttons .button{
    background: {$accentColor};}
.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove{
    background-color: {$accentColor};}
.widget_shopping_cart .widget_shopping_cart_content .mini_cart_item .ppRemove a.remove:hover{background-color: {$alternateColor};}
.menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents{font: normal 10px/1 \"{$menuFont}\";
    background-color: {$accentColor};}
.btAccentDarkHeader .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.btAccentDarkHeader .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents,
.btAccentDarkHeader .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetIcon span.cart-contents{background-color: {$alternateColor};}
.btMenuVertical .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler,
.btMenuVertical .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler{
    background-color: {$accentColor};}
.btMenuVertical .menuPort .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover,
.btMenuVertical .topTools .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover,
.btMenuVertical .topBarInLogoArea .widget_shopping_cart .widget_shopping_cart_content .btCartWidgetInnerContent .verticalMenuCartToggler:hover{
    background-color: {$alternateColor};}
.widget_recent_reviews li a .product-title{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.widget_recent_reviews li .reviewer{font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle{
    background-color: {$accentColor};}
.btBox .tagcloud a,
.btTags ul a,
.widget_block .tagcloud a{
    font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.btBox .tagcloud a:before,
.btTags ul a:before,
.widget_block .tagcloud a:before{
    color: {$accentColor};}
.btBox .tagcloud a:hover,
.btTags ul a:hover,
.widget_block .tagcloud a:hover{color: {$accentColor};}
.topTools a.btIconWidget:hover,
.topBarInMenu a.btIconWidget:hover{color: {$accentColor};}
.btAccentIconWidget.btIconWidget .btIconWidgetIcon{color: {$accentColor};}
a.btAccentIconWidget.btIconWidget:hover{color: {$accentColor};}
.bt-site-footer-widgets .btSearch button,
.bt-site-footer-widgets .btSearch input[type=submit],
.btSidebar .btSearch button,
.btSidebar .btSearch input[type=submit],
.btSidebar .widget_product_search button,
.btSidebar .widget_product_search input[type=submit],
.widget_block.widget_search .wp-block-search__inside-wrapper button,
.widget_block.widget_search .wp-block-search__inside-wrapper input[type=submit]{
    color: {$accentColor};}
.bt-site-footer-widgets .btSearch button:before,
.btSidebar .btSearch button:before,
.btSidebar .widget_product_search button:before,
.widget_block.widget_search .wp-block-search__inside-wrapper button:before{
    color: {$accentColor};}
.btSearchInner.btFromTopBox .btSearchInnerClose .bt_bb_icon a.bt_bb_icon_holder{color: {$accentColor};}
.btSearchInner.btFromTopBox .btSearchInnerClose .bt_bb_icon:hover a.bt_bb_icon_holder{color: {$accentColorDark};}
.btSearchInner.btFromTopBox button:hover:before{color: {$accentColor};}
.btSquareButtons .btButtonWidget a{min-height: {$logoHeight}px;}
.btSpecialTransparentLightHeader.btMenuHorizontal.btSquareButtons .topBarInMenu .topBarInMenuCell .btButtonWidget.bt_bb_button a{min-height: {$logoHeight}px !important;}
.btStickyHeaderActive.btMenuHorizontal .mainHeader:not(.gutter) .bt-logo-area .topBarInMenu .btButtonWidget a{min-height: {$stickyLogoHeight}px !important;}
.bt_bb_separator.bt_bb_border_style_solid.bt_bb_border_color_accent,
.bt_bb_separator.bt_bb_border_style_dotted.bt_bb_border_color_accent,
.bt_bb_separator.bt_bb_border_style_dashed.bt_bb_border_color_accent{border-color: {$accentColor};}
.bt_bb_separator.bt_bb_border_style_solid.bt_bb_border_color_alternate,
.bt_bb_separator.bt_bb_border_style_dotted.bt_bb_border_color_alternate,
.bt_bb_separator.bt_bb_border_style_dashed.bt_bb_border_color_alternate{border-color: {$alternateColor};}
.bt_bb_headline .bt_bb_headline_superheadline{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_dash_top.bt_bb_headline .bt_bb_headline_superheadline:before,
.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_superheadline:before{
    background: {$accentColor};}
.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top.bt_bb_headline .bt_bb_headline_superheadline:after,
.btSupertitleDash_skew.btSquareButtons .bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_superheadline:after{
    background: {$accentColor};}
.bt_bb_headline.bt_bb_subheadline .bt_bb_headline_subheadline{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_headline h1 b,
.bt_bb_headline h2 b,
.bt_bb_headline h3 b,
.bt_bb_headline h4 b,
.bt_bb_headline h5 b,
.bt_bb_headline h6 b{color: {$accentColor};}
.bt_bb_headline h1 u:before,
.bt_bb_headline h2 u:before,
.bt_bb_headline h3 u:before,
.bt_bb_headline h4 u:before,
.bt_bb_headline h5 u:before,
.bt_bb_headline h6 u:before{
    background-color: {$accentColor};}
.bt_bb_headline h1 u:after,
.bt_bb_headline h2 u:after,
.bt_bb_headline h3 u:after,
.bt_bb_headline h4 u:after,
.bt_bb_headline h5 u:after,
.bt_bb_headline h6 u:after{
    background-color: {$accentColor};}
.bt_bb_dash_bottom.bt_bb_headline .bt_bb_headline_content:after,
.bt_bb_dash_top_bottom.bt_bb_headline .bt_bb_headline_content:after{
    border-color: {$accentColor};}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_supertitle{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_supertitle b{color: {$accentColor};}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_title{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_service .bt_bb_service_content .bt_bb_service_content_text{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_service:hover .bt_bb_service_content_title a{color: {$accentColor};}
.bt_bb_progress_bar .bt_bb_progress_bar_text_above span{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta:before{
    background: {$accentColor};}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta > span{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_meta .bt_bb_latest_posts_item_category ul li a{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_latest_posts .bt_bb_latest_posts_item .bt_bb_latest_posts_item_content .bt_bb_latest_posts_item_title a:hover{color: {$accentColor};}
.bt_bb_masonry_post_grid .bt_bb_post_grid_filter .bt_bb_post_grid_filter_item{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_masonry_post_grid .bt_bb_post_grid_filter .bt_bb_post_grid_filter_item:after{
    background-color: {$accentColor};}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_meta:before{
    background: {$accentColor};}
.bt_bb_style_dark_alternate.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_meta:before{background: {$alternateColor};}
.bt_bb_style_light_alternate.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_meta:before{background: {$alternateColor};}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_meta > span{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_meta .bt_bb_grid_item_category ul li a{
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_masonry_post_grid .bt_bb_grid_item .bt_bb_grid_item_inner .bt_bb_grid_item_post_content .bt_bb_grid_item_post_title a:hover{color: {$accentColor};}
.bt_bb_masonry_post_grid .bt_bb_post_grid_loader{
    border-top: 2px solid {$accentColor};}
.bt_bb_masonry_image_grid .bt_bb_masonry_post_image_content .bt_bb_grid_item .bt_bb_grid_item_inner:after{
    background: {$accentColor};}
button.slick-arrow:hover:before{color: {$accentColor};}
.bt_bb_content_slider.bt_bb_show_dots_right ul li:hover button,
.bt_bb_content_slider.bt_bb_show_dots_right ul li.slick-active button{background-color: {$accentColor} !important;}
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_accent ul li button{background-color: {$accentColor} !important;}
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_alternate ul li button{background-color: {$alternateColor} !important;}
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_dark ul li:hover button,
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_dark ul li.slick-active button{background-color: {$accentColor} !important;}
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_accent ul li:hover button,
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_accent ul li.slick-active button{background-color: {$alternateColor} !important;}
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_alternate ul li:hover button,
.bt_bb_content_slider.bt_bb_show_dots_right.bt_bb_navigation_color_alternate ul li.slick-active button{background-color: {$accentColor} !important;}
.bt_bb_navigation_color_accent ul.slick-dots li{border-color: {$accentColor};}
.bt_bb_navigation_color_alternate ul.slick-dots li{border-color: {$alternateColor};}
ul.slick-dots li.slick-active,
ul.slick-dots li:hover{border-color: {$accentColor} !important;}
ul.slick-dots li.slick-active button,
ul.slick-dots li:hover button{background-color: {$accentColor} !important;}
.bt_bb_navigation_color_accent ul.slick-dots li.slick-active,
.bt_bb_navigation_color_accent ul.slick-dots li:hover{border-color: {$alternateColor};}
.bt_bb_navigation_color_accent ul.slick-dots li.slick-active button,
.bt_bb_navigation_color_accent ul.slick-dots li:hover button{background-color: {$alternateColor} !important;}
.bt_bb_navigation_color_accent ul.slick-dots li.slick-active button,
.bt_bb_navigation_color_accent ul.slick-dots li:hover button{background-color: {$alternateColor};}
.bt_bb_navigation_color_accent ul.slick-dots li.slick-active button button,
.bt_bb_navigation_color_accent ul.slick-dots li:hover button button{background-color: {$alternateColor} !important;}
.bt_bb_tabs ul.bt_bb_tabs_header li span{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_counter_holder .bt_bb_counter_content .bt_bb_counter{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_counter_holder .bt_bb_counter_content .bt_bb_counter_text{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_text_size_normal.bt_bb_counter_holder .bt_bb_counter_content .bt_bb_counter_text{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_text_size_small.bt_bb_counter_holder .bt_bb_counter_content .bt_bb_counter_text{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_countdown.btCounterHolder .btCountdownHolder > span{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_countdown.btCounterHolder .btCountdownHolder span[class$=\"_text\"]{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title:after{
    background: {$accentColor};}
.bt_bb_accordion .bt_bb_accordion_item .bt_bb_accordion_item_title:hover{color: {$accentColor};}
.bt_bb_price_color_accent.bt_bb_price_list .bt_bb_price_list_price{color: {$accentColor};}
.bt_bb_price_color_alternate.bt_bb_price_list .bt_bb_price_list_price{color: {$alternateColor};}
.bt_bb_price_list .bt_bb_price_list_price .bt_bb_price_list_currency{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_price_list ul.bt_bb_price_list_list li.bt_bb_price_list_item:before{
    color: {$accentColor};}
.bt_bb_price_list.bt_bb_border_accent{-webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.bt_bb_price_list.bt_bb_border_alternate{-webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_promo span{font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_promo a:hover{color: {$accentColor};}
.bt_bb_button .bt_bb_button_text{font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_button.bt_bb_style_clean a:hover{color: {$accentColor};}
.wpcf7-form .wpcf7-submit,
.wpcf7-form button#submit{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;
    color: {$accentColor} !important;}
.wpcf7-form .wpcf7-submit:hover,
.wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
div.wpcf7-validation-errors,
div.wpcf7-acceptance-missing{border: 2px solid {$accentColor};}
span.wpcf7-not-valid-tip{color: {$accentColor};}
.wpcf7 form.invalid .wpcf7-response-output,
.wpcf7 form.unaccepted .wpcf7-response-output,
.wpcf7 form.failed .wpcf7-response-output,
.wpcf7 form.aborted .wpcf7-response-output{border-color: {$accentColor};}
.btNewsletter .btNewsletterColumn input:focus{border-color: {$accentColor};}
.btContact .btContactRow textarea:focus{border-color: {$accentColor};}
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit,
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit'],
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit:hover{color: {$accentColor} !important;
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit:hover{color: {$accentColor} !important;}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit:hover{color: {$alternateColor} !important;
    -webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_filled .wpcf7-form button#submit:hover{color: {$alternateColor} !important;
    -webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit,
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit'],
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset !important;
    box-shadow: 0 0 0 0 {$accentColor} inset !important;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit:hover{color: {$accentColor} !important;
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset;
    box-shadow: 0 0 0 0 {$accentColor} inset;}
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_dark_accent.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit:hover{color: {$accentColor} !important;}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit:hover{color: {$alternateColor} !important;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_clean .wpcf7-form button#submit:hover{color: {$alternateColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_half_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset !important;
    box-shadow: 0 0 0 0 {$accentColor} inset !important;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_half_filled .wpcf7-form button#submit{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_half_filled .wpcf7-form button#submit:before{
    background-color: {$accentColor};}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_half_filled .wpcf7-form button#submit:before{background-color: {$alternateColor} !important;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_half_filled .wpcf7-form button#submit:before{background-color: {$alternateColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 0 {$accentColor} inset !important;
    box-shadow: 0 0 0 0 {$accentColor} inset !important;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit:before{
    background-color: {$accentColor};}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit:before{background-color: {$alternateColor} !important;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit:before{background-color: {$alternateColor} !important;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_skew_filled .wpcf7-form button#submit:hover{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit,
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit'],
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit,
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit'],
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_dark_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_light_alternate.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form .wpcf7-submit:hover,
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form input[type='submit']:hover,
.bt_bb_submit_button_colors_accent_light.bt_bb_contact_form_7.bt_bb_submit_button_style_special_filled .wpcf7-form button#submit:hover{color: {$accentColor} !important;}
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form .wpcf7-submit,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form input[type='submit'],
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form button#submit{color: {$alternateColor} !important;
    -webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_dark_alternate .wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form .wpcf7-submit,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form input[type='submit'],
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form button#submit{color: {$alternateColor} !important;
    -webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_light_alternate .wpcf7-form button#submit:hover{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
.bt_bb_contact_form_7.bt_bb_submit_button_colors_accent_light .wpcf7-form .wpcf7-submit:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_accent_light .wpcf7-form input[type='submit']:hover,
.bt_bb_contact_form_7.bt_bb_submit_button_colors_accent_light .wpcf7-form button#submit:hover{color: {$accentColor} !important;}
.bt_bb_card_image.bt_bb_border_accent{
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.bt_bb_card_image.bt_bb_border_alternate{
    -webkit-box-shadow: 0 0 0 1px {$alternateColor} inset;
    box-shadow: 0 0 0 1px {$alternateColor} inset;}
.bt_bb_link .bt_bb_link_content .bt_bb_headline a:before{
    -webkit-text-fill-color: {$accentColor};}
.bt_bb_link:hover:not(.btNoLink) .bt_bb_link_content .bt_bb_headline a:after{
    color: {$accentColor};}
.bt_bb_testimonial .bt_bb_testimonial_content .bt_bb_testimonial_ratings .bt_bb_testimonial_icon span:before{
    color: {$accentColor};}
.bt_bb_stars_color_alternate.bt_bb_testimonial .bt_bb_testimonial_content .bt_bb_testimonial_ratings .bt_bb_testimonial_icon span:before{color: {$alternateColor};}
.bt_bb_testimonial .bt_bb_testimonial_content .bt_bb_testimonial_name .bt_bb_headline h6{color: {$accentColor};}
.bt_bb_name_color_alternate.bt_bb_testimonial .bt_bb_testimonial_content .bt_bb_testimonial_name .bt_bb_headline h6{color: {$alternateColor};}
.bt_bb_schedule .bt_bb_schedule_title_flex .bt_bb_headline .bt_bb_headline_content small{font-family: \"{$bodyFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_schedule .bt_bb_schedule_content .bt_bb_schedule_inner_row.btToday .bt_bb_schedule_day span:before{
    color: {$accentColor};}
.bt_bb_schedule .bt_bb_schedule_content .bt_bb_schedule_inner_row.btToday .bt_bb_schedule_time span:before{
    color: {$accentColor};}
.bt_bb_event .bt_bb_event_date{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
.bt_bb_organic_animation_fill.bt_bb_organic_animation .item .item__deco{fill: {$alternateColor};}
.bt_bb_organic_animation_fill_accent.bt_bb_organic_animation .item .item__deco{fill: {$accentColor};}
.bt_bb_organic_animation_stroke.bt_bb_organic_animation .item .item__deco{stroke: {$alternateColor};}
.bt_bb_organic_animation_stroke_accent.bt_bb_organic_animation .item .item__deco{stroke: {$accentColor};}
.bt_bb_organic_animation .item .item__meta .item__subtitle{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_organic_animation .item .item__meta .item__arrow:before{
    background: {$accentColor};}
.bt_bb_single_product .bt_bb_single_product_content .bt_bb_single_product_title a:hover{color: {$accentColor};}
.bt_bb_single_product .bt_bb_single_product_content .bt_bb_single_product_price{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.bt_bb_single_product .bt_bb_single_product_content .bt_bb_single_product_price ins{
    color: {$accentColor};}
.bt_bb_single_product .bt_bb_single_product_content .bt_bb_single_product_button .added:after,
.bt_bb_single_product .bt_bb_single_product_content .bt_bb_single_product_button .loading:after{
    background-color: {$alternateColor} !important;}
.products ul li.product .btWooShopLoopItemInner .price,
ul.products li.product .btWooShopLoopItemInner .price{
    font-family: \"{$headingSubTitleFont}\",Arial,Helvetica,sans-serif;}
.products ul li.product .btWooShopLoopItemInner .price ins,
ul.products li.product .btWooShopLoopItemInner .price ins{
    color: {$accentColor};}
.products ul li.product .btWooShopLoopItemInner .added:after,
.products ul li.product .btWooShopLoopItemInner .loading:after,
ul.products li.product .btWooShopLoopItemInner .added:after,
ul.products li.product .btWooShopLoopItemInner .loading:after{
    background-color: {$accentColor};}
.products ul li.product .btWooShopLoopItemInner .added_to_cart,
ul.products li.product .btWooShopLoopItemInner .added_to_cart{
    color: {$accentColor};}
.products ul li.product .onsale,
ul.products li.product .onsale{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
nav.woocommerce-pagination ul li a:focus,
nav.woocommerce-pagination ul li a:hover,
nav.woocommerce-pagination ul li a.next,
nav.woocommerce-pagination ul li a.prev,
nav.woocommerce-pagination ul li span.current{color: {$accentColor};}
nav.woocommerce-pagination ul li a.page-numbers.next:after,
nav.woocommerce-pagination ul li a.page-numbers.prev:after{
    color: {$accentColor};}
div.product .onsale{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;
    background: {$accentColor};}
div.product div.images .woocommerce-product-gallery__trigger:after{
    -webkit-box-shadow: 0 0 0 2em {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;
    box-shadow: 0 0 0 2em {$accentColor} inset,0 0 0 2em rgba(255,255,255,.5) inset;}
div.product div.summary .price ins{
    color: {$accentColor};}
table.shop_table thead th{
    font-family: \"{$headingFont}\",Arial,Helvetica,sans-serif;}
table.shop_table .coupon .input-text{
    color: {$accentColor};}
table.shop_table td.product-remove a.remove{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
table.shop_table td.product-remove a.remove:hover{
    -webkit-box-shadow: 0 0 0 3em {$alternateColor} inset;
    box-shadow: 0 0 0 3em {$alternateColor} inset;}
ul.wc_payment_methods li .about_paypal{
    color: {$accentColor};}
.woocommerce-MyAccount-navigation ul li a{
    border-bottom: 2px solid {$accentColor};}
.woocommerce-info a:not(.button),
.woocommerce-message a:not(.button){color: {$accentColor};}
.woocommerce-message:before,
.woocommerce-info:before{
    color: {$accentColor};}
.woocommerce .btSidebar a.button,
.woocommerce .bt-content a.button,
.woocommerce-page .btSidebar a.button,
.woocommerce-page .bt-content a.button,
.woocommerce .btSidebar input[type=\"submit\"],
.woocommerce .bt-content input[type=\"submit\"],
.woocommerce-page .btSidebar input[type=\"submit\"],
.woocommerce-page .bt-content input[type=\"submit\"],
.woocommerce .btSidebar button[type=\"submit\"],
.woocommerce .bt-content button[type=\"submit\"],
.woocommerce-page .btSidebar button[type=\"submit\"],
.woocommerce-page .bt-content button[type=\"submit\"],
.woocommerce .btSidebar input.button,
.woocommerce .bt-content input.button,
.woocommerce-page .btSidebar input.button,
.woocommerce-page .bt-content input.button,
.woocommerce .btSidebar input.alt:hover,
.woocommerce .bt-content input.alt:hover,
.woocommerce-page .btSidebar input.alt:hover,
.woocommerce-page .bt-content input.alt:hover,
.woocommerce .btSidebar a.button.alt:hover,
.woocommerce .bt-content a.button.alt:hover,
.woocommerce-page .btSidebar a.button.alt:hover,
.woocommerce-page .bt-content a.button.alt:hover,
.woocommerce .btSidebar .button.alt:hover,
.woocommerce .bt-content .button.alt:hover,
.woocommerce-page .btSidebar .button.alt:hover,
.woocommerce-page .bt-content .button.alt:hover,
.woocommerce .btSidebar button.alt:hover,
.woocommerce .bt-content button.alt:hover,
.woocommerce-page .btSidebar button.alt:hover,
.woocommerce-page .bt-content button.alt:hover,
div.woocommerce a.button,
div.woocommerce input[type=\"submit\"],
div.woocommerce button[type=\"submit\"],
div.woocommerce input.button,
div.woocommerce input.alt:hover,
div.woocommerce a.button.alt:hover,
div.woocommerce .button.alt:hover,
div.woocommerce button.alt:hover{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.woocommerce .btSidebar a.button,
.woocommerce .bt-content a.button,
.woocommerce-page .btSidebar a.button,
.woocommerce-page .bt-content a.button,
.woocommerce .btSidebar input[type=\"submit\"],
.woocommerce .bt-content input[type=\"submit\"],
.woocommerce-page .btSidebar input[type=\"submit\"],
.woocommerce-page .bt-content input[type=\"submit\"],
.woocommerce .btSidebar button[type=\"submit\"],
.woocommerce .bt-content button[type=\"submit\"],
.woocommerce-page .btSidebar button[type=\"submit\"],
.woocommerce-page .bt-content button[type=\"submit\"],
.woocommerce .btSidebar input.button,
.woocommerce .bt-content input.button,
.woocommerce-page .btSidebar input.button,
.woocommerce-page .bt-content input.button,
.woocommerce .btSidebar input.alt:hover,
.woocommerce .bt-content input.alt:hover,
.woocommerce-page .btSidebar input.alt:hover,
.woocommerce-page .bt-content input.alt:hover,
.woocommerce .btSidebar a.button.alt:hover,
.woocommerce .bt-content a.button.alt:hover,
.woocommerce-page .btSidebar a.button.alt:hover,
.woocommerce-page .bt-content a.button.alt:hover,
.woocommerce .btSidebar .button.alt:hover,
.woocommerce .bt-content .button.alt:hover,
.woocommerce-page .btSidebar .button.alt:hover,
.woocommerce-page .bt-content .button.alt:hover,
.woocommerce .btSidebar button.alt:hover,
.woocommerce .bt-content button.alt:hover,
.woocommerce-page .btSidebar button.alt:hover,
.woocommerce-page .bt-content button.alt:hover,
div.woocommerce a.button,
div.woocommerce input[type=\"submit\"],
div.woocommerce button[type=\"submit\"],
div.woocommerce input.button,
div.woocommerce input.alt:hover,
div.woocommerce a.button.alt:hover,
div.woocommerce .button.alt:hover,
div.woocommerce button.alt:hover{
    color: {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btDashColor_dark_accent.woocommerce .btSidebar a.button,
.btDashColor_dark_accent.woocommerce .bt-content a.button,
.btDashColor_dark_accent.woocommerce-page .btSidebar a.button,
.btDashColor_dark_accent.woocommerce-page .bt-content a.button,
.btDashColor_dark_accent.woocommerce .btSidebar input[type=\"submit\"],
.btDashColor_dark_accent.woocommerce .bt-content input[type=\"submit\"],
.btDashColor_dark_accent.woocommerce-page .btSidebar input[type=\"submit\"],
.btDashColor_dark_accent.woocommerce-page .bt-content input[type=\"submit\"],
.btDashColor_dark_accent.woocommerce .btSidebar button[type=\"submit\"],
.btDashColor_dark_accent.woocommerce .bt-content button[type=\"submit\"],
.btDashColor_dark_accent.woocommerce-page .btSidebar button[type=\"submit\"],
.btDashColor_dark_accent.woocommerce-page .bt-content button[type=\"submit\"],
.btDashColor_dark_accent.woocommerce .btSidebar input.button,
.btDashColor_dark_accent.woocommerce .bt-content input.button,
.btDashColor_dark_accent.woocommerce-page .btSidebar input.button,
.btDashColor_dark_accent.woocommerce-page .bt-content input.button,
.btDashColor_dark_accent.woocommerce .btSidebar input.alt:hover,
.btDashColor_dark_accent.woocommerce .bt-content input.alt:hover,
.btDashColor_dark_accent.woocommerce-page .btSidebar input.alt:hover,
.btDashColor_dark_accent.woocommerce-page .bt-content input.alt:hover,
.btDashColor_dark_accent.woocommerce .btSidebar a.button.alt:hover,
.btDashColor_dark_accent.woocommerce .bt-content a.button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .btSidebar a.button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .bt-content a.button.alt:hover,
.btDashColor_dark_accent.woocommerce .btSidebar .button.alt:hover,
.btDashColor_dark_accent.woocommerce .bt-content .button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .btSidebar .button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .bt-content .button.alt:hover,
.btDashColor_dark_accent.woocommerce .btSidebar button.alt:hover,
.btDashColor_dark_accent.woocommerce .bt-content button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .btSidebar button.alt:hover,
.btDashColor_dark_accent.woocommerce-page .bt-content button.alt:hover,
.btDashColor_dark_accentdiv.woocommerce a.button,
.btDashColor_dark_accentdiv.woocommerce input[type=\"submit\"],
.btDashColor_dark_accentdiv.woocommerce button[type=\"submit\"],
.btDashColor_dark_accentdiv.woocommerce input.button,
.btDashColor_dark_accentdiv.woocommerce input.alt:hover,
.btDashColor_dark_accentdiv.woocommerce a.button.alt:hover,
.btDashColor_dark_accentdiv.woocommerce .button.alt:hover,
.btDashColor_dark_accentdiv.woocommerce button.alt:hover{color: {$accentColor} !important;}
.woocommerce .btSidebar a.button:hover,
.woocommerce .bt-content a.button:hover,
.woocommerce-page .btSidebar a.button:hover,
.woocommerce-page .bt-content a.button:hover,
.woocommerce .btSidebar input[type=\"submit\"]:hover,
.woocommerce .bt-content input[type=\"submit\"]:hover,
.woocommerce-page .btSidebar input[type=\"submit\"]:hover,
.woocommerce-page .bt-content input[type=\"submit\"]:hover,
.woocommerce .btSidebar button[type=\"submit\"]:hover,
.woocommerce .bt-content button[type=\"submit\"]:hover,
.woocommerce-page .btSidebar button[type=\"submit\"]:hover,
.woocommerce-page .bt-content button[type=\"submit\"]:hover,
.woocommerce .btSidebar input.button:hover,
.woocommerce .bt-content input.button:hover,
.woocommerce-page .btSidebar input.button:hover,
.woocommerce-page .bt-content input.button:hover,
.woocommerce .btSidebar input.alt,
.woocommerce .bt-content input.alt,
.woocommerce-page .btSidebar input.alt,
.woocommerce-page .bt-content input.alt,
.woocommerce .btSidebar a.button.alt,
.woocommerce .bt-content a.button.alt,
.woocommerce-page .btSidebar a.button.alt,
.woocommerce-page .bt-content a.button.alt,
.woocommerce .btSidebar .button.alt,
.woocommerce .bt-content .button.alt,
.woocommerce-page .btSidebar .button.alt,
.woocommerce-page .bt-content .button.alt,
.woocommerce .btSidebar button.alt,
.woocommerce .bt-content button.alt,
.woocommerce-page .btSidebar button.alt,
.woocommerce-page .bt-content button.alt,
div.woocommerce a.button:hover,
div.woocommerce input[type=\"submit\"]:hover,
div.woocommerce button[type=\"submit\"]:hover,
div.woocommerce input.button:hover,
div.woocommerce input.alt,
div.woocommerce a.button.alt,
div.woocommerce .button.alt,
div.woocommerce button.alt{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.star-rating span:before{
    color: {$accentColor};}
p.stars a[class^=\"star-\"].active:after,
p.stars a[class^=\"star-\"]:hover:after{color: {$accentColor};}
#review_form .comment-form .form-submit input[type=\"submit\"]{
    -webkit-box-shadow: 0 0 0 3em {$accentColor} inset;
    box-shadow: 0 0 0 3em {$accentColor} inset;}
.select2-container--default .select2-results__option--highlighted[aria-selected],
.select2-container--default .select2-results__option--highlighted[data-selected]{background-color: {$accentColor};}
p.demo_store{
    background-color: {$alternateColor};}
.btWooCommerce .products .product-category a:hover{color: {$accentColor};}
.btQuoteBooking .btContactNext{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;}
.btQuoteBooking .btContactNext:hover{
    color: {$accentColor};}
.btQuoteBooking .btQuoteSwitch.on .btQuoteSwitchInner{background: {$accentColor};}
.btQuoteBooking textarea:focus,
.btQuoteBooking input[type=\"text\"]:focus,
.btQuoteBooking input[type=\"email\"]:focus,
.btQuoteBooking input[type=\"password\"]:focus,
.btQuoteBooking .fancy-select .trigger:focus,
.btQuoteBooking .ddcommon.borderRadius .ddTitleText:focus,
.btQuoteBooking .ddcommon.borderRadiusTp .ddTitleText:focus,
.btQuoteBooking .ddcommon.borderRadiusBtm .ddTitleText:focus{-webkit-box-shadow: 0 0 0 0 {$accentColor} !important;
    box-shadow: 0 0 0 0 {$accentColor} !important;
    border-color: {$accentColor} !important;}
.btQuoteBooking .dd.ddcommon.borderRadiusTp .ddTitleText,
.btQuoteBooking .dd.ddcommon.borderRadiusBtm .ddTitleText{-webkit-box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);
    box-shadow: 5px 0 0 {$accentColor} inset,0 2px 10px rgba(0,0,0,.2);}
.btQuoteBooking .ui-slider .ui-slider-handle{background: {$accentColor};}
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal .btQuoteTotalCalc{
    background: {$accentColor};}
.btQuoteBooking .btQuoteBookingForm .btQuoteTotal .btQuoteTotalCurrency{
    background: {$accentColor};}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError input,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError textarea{
    border-color: {$accentColor};}
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusTp .ddTitleText,
.btQuoteBooking .btContactFieldMandatory.btContactFieldError .dd.ddcommon.borderRadiusBtm .ddTitleText{
    border-color: {$accentColor};}
.btQuoteBooking .btSubmitMessage{color: {$accentColor};}
.btQuoteBooking .dd.ddcommon.borderRadiusTp .ddTitleText,
.btQuoteBooking .dd.ddcommon.borderRadiusBtm .ddTitleText{-webkit-box-shadow: 0 0 0 0 {$accentColor} !important;
    box-shadow: 0 0 0 0 {$accentColor} !important;
    border-color: {$accentColor} !important;}
.btQuoteBooking .btContactSubmit{
    font-family: \"{$buttonFont}\",Arial,Helvetica,sans-serif;
    -webkit-box-shadow: 0 0 0 4em {$accentColor} inset;
    box-shadow: 0 0 0 4em {$accentColor} inset;}
.btQuoteBooking .btContactSubmit:hover{color: {$accentColor};
    -webkit-box-shadow: 0 0 0 1px {$accentColor} inset;
    box-shadow: 0 0 0 1px {$accentColor} inset;}
.btDatePicker .ui-datepicker-header{background-color: {$accentColor};}
.btFixedRightInner.bt_bb_text a:hover{color: {$accentColor} !important;}
.btRough.bold_timeline_container .bold_timeline_item_header_supertitle{color: {$accentColor} !important;
    font-family: \"{$headingSuperTitleFont}\",Arial,Helvetica,sans-serif;}
.btSlant.bold_timeline_container .bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_supertitle .bold_timeline_item_header_supertitle_inner{background: {$accentColor} !important;}
.btFluid.bold_timeline_container .bold_timeline_item_override_icon_position_inherit.bold_timeline_item .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 2em {$accentColor} inset !important;
    box-shadow: 0 0 0 2em {$accentColor} inset !important;}
.btStickyHeaderActive.btStickyHeaderOpen .btCustomSticky.btButtonWidget.bt_bb_button.bt_bb_style_special_filled.bt_bb_color_scheme_5.bt_bb_icon_color_scheme_2.btWithIcon.btWithLink .bt_bb_icon_holder{background-color: {$accentColor} !important;}
", array() );