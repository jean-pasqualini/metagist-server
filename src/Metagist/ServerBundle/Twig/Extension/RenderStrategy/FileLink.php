<?php
namespace Metagist\ServerBundle\Twig\Extension\RenderStrategy;

use Metagist\ServerBundle\Entity\Metainfo;

/**
 * Strategy to render metainfo links.
 * 
 * @author Daniel Pozzi <bonndan76@googlemail.com>
 */
class FileLink implements StrategyInterface
{
    /**
     * Renders the metainfo value as link, displays only the file name.
     * 
     * @param \Metagist\MetaInfo $metaInfo
     * @return string
     */
    public function render(Metainfo $metaInfo)
    {
        $template = '<a href="%s" target="_blank">%s</a>';
        return sprintf($template, $metaInfo->getValue(), basename($metaInfo->getValue()));
    }

}