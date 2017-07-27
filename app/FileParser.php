<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/26
 * Time: 14:34
 */

namespace App;

/*
 * File Parser
 * read, filter, parse and format {csv, tsv, dsv, variable-length-delimited} and other txt files
 *
 * Author: Nuno Chaves <nunochaves@sapo.pt>
 * */
class FileParser {
    private $filePath = null;

    private $filter = null;
    private $each = null;
    private $head =null;
    private $fromEncoding = null;
    private $toEncoding = null;
    private $delimiter = ' ';
    public $header = [];
    /**
     * @return static
     */
    public static function instance()
    {
        return new static();
    }
    /**
     * set file to be parsed
     *
     * @param $filePath
     * @param string $delimiter
     * @return $this
     */
    public function setFile($filePath, $delimiter = null)
    {
        $this->filePath = $filePath;
        $this->delimiter = $delimiter;
        return $this;
    }
    /**
     * set encoding conversion options
     *
     * @param string $fromEncoding
     * @param string $toEncoding
     * @return $this
     */
    public function setEncoding($fromEncoding = 'UTF-8', $toEncoding = 'UTF-8')
    {
        $this->fromEncoding = $fromEncoding;
        $this->toEncoding = $toEncoding;
        return $this;
    }

    /**
     * set a callable to be called on each line to filter lines to retrieve
     * callable must have one param $line and return a boolean
     *
     * @param callable $callable
     * @return $this
     */
    public function filter(callable $callable)
    {
        $this->filter = $callable;
        return $this;
    }


    public function head(callable $callable)
    {
        $this->head = $callable;
        return $this;
    }

    /**
     * set a callable to be called on each line
     * callable must have one param $line and return $line
     *
     * @param callable $callable
     * @return $this
     */
    public function each(callable $callable)
    {
        $this->each = $callable;
        return $this;
    }

    /**
     * Parse file and return file contents
     *
     * @return array
     */
    public function parse()
    {
        $lines= [];
        $file = fopen($this->filePath, "r");
        while (($line = fgets($file)) !== false) {

            //head必须放到最前面
            if(is_callable($this->head)){

                $func = $this->head;
                $out = $func($line);

                if(isset($out)){

                    $this->header = null;
                    $this->header =$out;
                }
            }


            // execute callable to filter line
            if (is_callable($this->filter)) {
                $func = $this->filter;
                if (!(boolean)$func($line)) continue;
             }



            // execute callable for each line
            if (is_callable($this->each)) {
                $func = $this->each;
                $line = $func($line);

            }

            $lines[] = array_merge($line, $this->header, addtimestamp());


        }
        return $lines;
    }
}
