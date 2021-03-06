<?php

/**
 * Collection Controller
 *
 * To manage the Collection such as create, edit and delete
 *
 * @name       Collection Controller
 * @version    1.0
 * @author     Contus Team <developers@contus.in>
 * @copyright  Copyright (C) 2016 Contus. All rights reserved.
 * @license    GNU General Public License http://www.gnu.org/copyleft/gpl.html
 */
namespace Contus\Video\Http\Controllers\Admin;

use Contus\Base\Controller as BaseController;

class CollectionController extends BaseController {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\View
   */
  public function getIndex() {
    return view ( 'video::admin.collections.index');
  }
  
  /**
   * get Grid template
   *
   * @return \Illuminate\Http\View
   */
  public function getGridlist() {
    return view ( 'video::admin.collections.gridView' );
  }
  /**
   * Controller function to get the collection videos.
   *
   * @param integer $id The id of the collection.
   * @return Ambigous <\Contus\Base\response, \Illuminate\Http\JsonResponse>
   */
  public function getVideos($id) {
      return view ( 'video::admin.collections.videos', [
              'id' => $id
      ] );
  }
}
