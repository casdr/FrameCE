<?php
class home {
    public function index() {
        view::add('test', array('test'=>'boem'));
    }
}