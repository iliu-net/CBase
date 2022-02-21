<?php

class Category extends CBaseModel {
  public function table_name() { return 'cbCategory'; }

  public function list_cats() {
    return $this->define_dict('name');
  }
}
