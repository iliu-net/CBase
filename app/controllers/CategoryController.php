<?php
class CategoryController extends CBaseController {
  public function index($f3,$params) {
    if (isset($params['msg'])) {
      $f3->set('msg',$params['msg']);
    } else {
      $f3->set('msg','');
    }
    $cats = new Category($this->db);
    $f3->set('categories',$cats->find());
    echo View::instance()->render('category-list.html');
  }

  public function create($f3,$params) {
    if ($f3->exists('POST.create')) {
      $cats = new Category($this->db);
      $cats->reset();
      $cats->add();
      $f3->reroute('/category/msg/New category created');
      return;
    }
    $f3->set('form_action',Sc::url('/category/create'));
    $f3->set('page_head','Create Category');
    $f3->set('form_command','create');
    $f3->set('form_label','New Category');
    echo View::instance()->render('category-detail.html');
  }


  public function update($f3,$params) {
    $cats = new Category($this->db);
    if ($f3->exists('POST.update')) {
      //~ echo '<pre>';
      //~ echo '$params'.PHP_EOL;
      //~ var_dump($params);
      //~ echo 'POST'.PHP_EOL;
      //~ var_dump($f3->get('POST'));
      //~ echo '</pre>';
      $cats->reset();
      $cats->edit($params['id']);
      $f3->reroute('/category/msg/Entry '.$params['id'].'  updated');
      return;
    }
    $cats->get_by_id($params['id']);
    //~ echo '<pre>';
    //~ echo '$params'.PHP_EOL;
    //~ var_dump($params);
    //~ echo 'POST'.PHP_EOL;
    //~ var_dump($f3->get('POST'));
    //~ echo '</pre>';
    //~ return;
    if (!$f3->get('POST.id')) {
      $f3->reroute('/category/msg/Lookup Error ('.$params['id'].')');
      return;
    }
    $f3->set('form_action',Sc::url('/category/update/'.$params['id']));
    $f3->set('page_head','Edit Category');
    $f3->set('form_command','update');
    $f3->set('form_label','Update');
    echo View::instance()->render('category-detail.html');
  }

  public function delete($f3,$params) {
    if (isset($params['id'])) {
      $id = $params['id'];
      $cats = new Category($this->db);
      $cats->delete($id);
      $f3->reroute('/category/msg/Entry '.$id.' deleted!');
    } else {
      $f3->reroute('/category/msg/No record deleted');
    }
  }
}
