<?php

namespace AyrshireMinis\GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * GalleryImage
 *
 * @ORM\Table(name="galleryimage")
 * @ORM\Entity(repositoryClass="AyrshireMinis\GalleryBundle\Entity\GalleryImageRepository")
 */
class GalleryImage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('classic', 'new')")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=4)
     */
    private $year;

    /**
     * @var integer
     *
     * @ORM\Column(name="ip_address", type="string")
     */
    private $ipAddress;

    /**
     * @var boolean
     *
     * @ORM\Column(name="approved", type="boolean", options={"default" = 0})
     */
    private $approved;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_uploaded", type="string")
     */
    private $dateUploaded;

    /**
     * @Assert\File(maxSize="6000000")
     */
    public $image;

    public function __construct()
    {
        $this->ipAddress    = $_SERVER['REMOTE_ADDR'];
        $this->approved     = false;
        $this->dateUploaded = date('Y-m-d H:i:s');
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return GalleryImage
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return GalleryImage
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return GalleryImage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set year
     *
     * @param string $year
     *
     * @return GalleryImage
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return string
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set ipAddress
     *
     * @param integer $ipAddress
     *
     * @return GalleryImage
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $_SERVER['REMOTE_ADDR'];

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return integer
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     *
     * @return GalleryImage
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set dateUploaded
     *
     * @param \DateTime $dateUploaded
     *
     * @return GalleryImage
     */
    public function setDateUploaded($dateUploaded)
    {
        $this->dateUploaded = $dateUploaded;

        return $this;
    }

    /**
     * Get dateUploaded
     *
     * @return \DateTime
     */
    public function getDateUploaded()
    {
        return $this->dateUploaded;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        //if (!$this->image) {
        //    return;
        //}

        // we use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the target filename to move to
        $this->image->move(__DIR__ . '/../../../../web/images/gallery', 'test.'.$this->image->guessExtension());

        // set the path property to the filename where you'ved saved the file
        //$this->setPath($this->id.'.'.$this->image->guessExtension());

        // clean up the file property as you won't need it anymore
        unset($this->image);
    }

}
