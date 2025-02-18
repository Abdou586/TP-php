<?php
class TaskController {
    private $taskModel;

    public function __construct($db) {
        $this->taskModel = new Task($db);
    }

    public function index() {
    }

    public function create() {
    }

    public function edit($id) {
    }

    public function delete($id) {
    }
}
?>