<?php
namespace Traits;
use \Request;

/**
 * 
 * 
 */
trait Model {
    use Database, Validations;
    private $request;

    public function __construct(\Request $request = null) {
        $this->request = $request !== null ? $request : new \Request;
    }

    public function index() {}

    public function show() {}

    public function store() {}

    public function update() {}

    public function delete() {}
}