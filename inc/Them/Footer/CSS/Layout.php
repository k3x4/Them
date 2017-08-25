<?php

namespace Them\Footer\CSS;

use Them\Footer;
use Them\ICSS;
use Them\Helpers;

class Layout implements ICSS{
    
    private $type;
    private $rows;
    
    public function __construct() {
        $footer = new Footer\Main\Layout;
        $containerType = $footer->getContainerType();
        $rowsName = $footer->getRowsName();
        $this->type = Helpers\Factory::make(__CLASS__, $containerType);
        $this->rows = Helpers\Factory::make(__CLASS__, $rowsName);
    }
    
    private function generalCSS(){
        $footer = new Footer\Main\Layout;
        $padding = $footer->getPadding();
        $paddingWidgets = $footer->getPaddingWidgets();
        
        $padding = Helpers\Converter::spacingToCSS($padding, 'padding');
        $paddingWidgets = Helpers\Converter::spacingToCSS($paddingWidgets, 'padding');
        
        $cssBlocks = [];
        $cssBlocks[] = [
            '.footer.container, .footer.container-fluid' => [
                'padding' => $padding
            ],
            '.footer.container .widget-area, .footer.container-fluid .widget-area' => [
                'padding' => $paddingWidgets,
            ]
        ];
        return $cssBlocks;
    }
   
    private function generalCSSMedia(){
        return [];
    }
    
    public function getCSS() {
        return array_merge($this->generalCSS(), $this->type->getCSS(), $this->rows->getCSS());
    }

    public function getCSSMedia() {
        $CSS = new Helpers\CSS;
        $generalCSSMedia = $this->generalCSSMedia();
        $typeCSSMedia = $this->type->getCSSMedia();
        $rowsCSSMedia = $this->rows->getCSSMedia();
        return $CSS->mediaMerge($generalCSSMedia, $typeCSSMedia, $rowsCSSMedia);
    }
    
}
