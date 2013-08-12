<?php
namespace Metagist\ServerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metainfo
 *
 * @ORM\Table(name="metainfo")
 * @ORM\Entity(repositoryClass="MetainfoRepository")
 */
class Metainfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time_updated", type="datetime", nullable=false)
     */
    private $timeUpdated;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=32, nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=32, nullable=false)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="group", type="string", length=32, nullable=false)
     */
    private $group;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=false)
     */
    private $value;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Packages
     *
     * @ORM\ManyToOne(targetEntity="Package")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     * })
     */
    private $package;

    /**
     * Factory method.
     * 
     * @param array $data
     * @return MetaInfo
     */
    public static function fromArray(array $data)
    {
        $info = new self();
        foreach ($data as $key => $value) {
            if (!property_exists($info, $key)) {
                continue;
            }
            $info->$key = $value;
        }
        
        return $info;
    }
    
    /**
     * Factory method to create metainfo based on values.
     * 
     * @param string $group
     * @param mixed  $value
     * @return MetaInfo
     */
    public static function fromValue($group, $value, $version = null)
    {
        return self::fromArray(
            array(
                'group'    => $group,
                'value'    => $value,
                'version'  => $version
            )
        );
    }

    /**
     * Set the related package.
     * 
     * @param Package $package
     */
    public function setPackage(Package $package)
    {
        $this->package = $package;
    }
    
    /**
     * Returns the related package.
     * 
     * @return Package|null
     */
    public function getPackage()
    {
        return $this->package;
    }
    
    /**
     * Returns the group name.
     * 
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    /**
     * Returns the value.
     * 
     * @return string|int
     */
    public function getValue()
    {
        return $this->value;
    }
    
    /**
     * Returns the associated version.
     * 
     * @return string|null
     */
    public function getVersion()
    {
        return $this->version;
    }
    
    /**
     * Set the version string.
     * 
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
    
    /**
     * Returns the id of the user who created the info.
     * 
     * @return int|null
     */
    public function getUserId()
    {
        return $this->user_id;
    }
    
    /**
     * Returns the time of the last update
     * 
     * @return string|null
     */
    public function getTimeUpdated()
    {
        return $this->time_updated;
    }
}
