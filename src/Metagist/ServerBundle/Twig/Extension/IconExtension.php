<?php
namespace Metagist\ServerBundle\Twig\Extension;

use Metagist\ServerBundle\Entity\Package;
use Metagist\ServerBundle\Entity\Metainfo;

/**
 * Twig extension to create icons.
 * 
 * To be used with twitter bootstrap.
 * 
 * @author Daniel Pozzi <bonndan76@googlemail.com>
 */
class IconExtension extends \Twig_Extension
{
    /**
     * key => icon class mapping
     * @var array
     */
    protected $mapping = array();
    
    /**
     * Init with the mapping to use.
     * 
     * @param array $mapping
     */
    public function __construct( $mapping)
    {
        $this->mapping = $mapping;
    }
    
    /**
     * Returns the usable methods.
     * 
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'icon'  => new \Twig_Function_Method($this, 'icon', array("is_safe" => array("html"))),
            'stars' => new \Twig_Function_Method($this, 'stars', array("is_safe" => array("html"))),
        );
    }
    
    /**
     * Returns a twitter bootstrap icon for a key.
     * 
     * @param string $key
     * @return string
     */
    public function icon($key) 
    {
        if (!array_key_exists($key, $this->mapping)) {
            return '';
        }
        
        $class = $this->mapping[$key];
        return '<i class="' . $class . '"></i>';
    }
    
    /**
     * Returns a number of star-icons as html.
     * 
     * @param int $rating
     * @return string
     */
    public function stars($rating)
    {
        $buffer = '';
        // {% for i in 1..latestRating.rating %}{% endfor %}
        for ($i=0; $i<5; $i++) {
            $iconType = ($i < $rating) ? 'fa-star' : 'fa-star-o';
            $buffer .= '<i class="symbol fa ' . $iconType . '"></i>';
        }
        
        return $buffer;
    }
    
    /**
     * Returns the name of the extension.
     * 
     * @return string
     */
    public function getName()
    {
        return 'metagist_icons';
    }
}
