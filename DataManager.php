<?php
class DataManager
{
    /*
     * Variable which has all databases in 2 dimensional table array
     */
    private $table = [];
    private $file_name = '';

    public function __construct($filename)
    {
        $this->file_name = $filename;
        if (file_exists($this->file_name)) {
            $content = file_get_contents($this->file_name);
            $data = json_decode($content, true);
            if (is_array($data)) {
                $this->table = $data;
            }
        }
    }

    /*
     * Saves value in database with keys - $r && $c
     * @param int $r - first key
     * @param int $c - second key
     * @param mixed $value - value which will be saved in database
     */
    public function save($r, $c, $value)
    {
        $this->table[$r][$c] = $value;
        $content = json_encode($this->table, JSON_PRETTY_PRINT);
        file_put_contents($this->file_name, $content);
    }

    /*
     * Returns data from database and takes $r and $c keys
     * @param int $r - first key
     * @param int $c - second key
     * 
     * @return mixed value form database || empty string
     */
    public function get($r, $c)
    {
        if (array_key_exists($r, $this->table) && array_key_exists($c, $this->table[$r])) {
            return $this->table[$r][$c];
        }

        return '';
    }

    /*
     * Returns all values which are stored in table  
     * @return int
     */
    public function count()
    {
        $count = 0;
        foreach ($this->table as $row) {
            foreach ($row as $value) {
                $count++;
            }
        }

        return $count;
    }

    public function deleteAll()
    {
        $this->table = [];
        file_put_contents($this->file_name, '');
    }
}
