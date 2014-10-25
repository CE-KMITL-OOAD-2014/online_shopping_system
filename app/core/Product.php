<?php 
	namespace core;

	class Product {

		protected $price;
		protected $category;
		protected $description;
		protected $size;
		protected $color;
		protected $suplier;
		protected $amount;
        protected $imgPath = "";

		public function __construct() {
		}

    /**
     * Gets the value of price.
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
    
    /**
     * Sets the value of price.
     *
     * @param mixed $price the price 
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the value of category.
     *
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    /**
     * Sets the value of category.
     *
     * @param mixed $category the category 
     *
     * @return self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Gets the value of description.
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the value of description.
     *
     * @param mixed $description the description 
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Gets the value of size.
     *
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }
    
    /**
     * Sets the value of size.
     *
     * @param mixed $size the size 
     *
     * @return self
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Gets the value of color.
     *
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }
    
    /**
     * Sets the value of color.
     *
     * @param mixed $color the color 
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Gets the value of suplier.
     *
     * @return mixed
     */
    public function getSuplier()
    {
        return $this->suplier;
    }
    
    /**
     * Sets the value of suplier.
     *
     * @param mixed $suplier the suplier 
     *
     * @return self
     */
    public function setSuplier($suplier)
    {
        $this->suplier = $suplier;

        return $this;
    }

    /**
     * Gets the value of amount.
     *
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }
    
    /**
     * Sets the value of amount.
     *
     * @param mixed $amount the amount 
     *
     * @return self
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

     /**
     * Gets the value of amount.
     *
     * @return mixed
     */
    public function getImgPath()
    {
        return $this->imgPath;
    }
    
    /**
     * Sets the value of amount.
     *
     * @param mixed $amount the amount 
     *
     * @return self
     */
    public function setImgPath($imgPath)
    {
        $this->imgPath = $imgPath;
        return $this;
    }
}