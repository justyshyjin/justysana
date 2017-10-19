<div class="panel main_container">
    <div class="tab-content">
        <div class="tab-pane active" id="latest_video">
            <div class="tab_search clearfix">
                <div id="st-trigger-effects" class="search_upload_btn pull-right column">
                    <button data-effect="st-effect-18" data-ng-click="groupCtrl.addgroup($event)" class="btn btn-primary upload_video pull-right" data-intialize-sidebar>
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        {{trans('video::playlist.add_group')}}
                    </button>
                </div>
            </div>
            <div id="table_loader" class="table_loader_container" data-ng-show="gridLoadingBar">
                <div class="table_loader">
                    <div class="loader"></div>
                </div>
            </div>
            <div class="table_responsive">
                <table class="table playlist_table">
                    <thead>
                        <tr>
                            <th class="center">{{trans('base::general.s_no')}}</th>
                            <th data-ng-repeat="field in heading">
                                @{{field.name}}
                                <span data-ng-if="field.sort==true" id="" class="th-inner sortable both" data-ng-class="{showGridArrow:field.sort}" data-ng-click="fieldOrder($event,field.value)"></span>
                                <span data-ng-if="field.sort==false" data-ng-class="{showGridArrow:field.sort}"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="search_text">
                            <td></td>
                            <td class="search_product">
                                <input type="text" class="form-control" data-ng-model="searchRecords.title" data-boot-tooltip="true" title="{{trans('video::playlist.enter_group_name')}}">
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <select class="form-control mb15" data-ng-change="search()" data-ng-model="searchRecords.is_active" data-boot-tooltip="true" title="{{trans('base::general.select_status')}}">
                                    <option value="all">{{trans('base::general.all')}}</option>
                                    <option value='1'>{{trans('video::playlist.banner.active')}}</option>
                                    <option value='0'>{{trans('video::playlist.banner.inactive')}}</option>
                                </select>
                            </td>
                            <td></td>
                            <td class="center">
                                <button type="button" class="btn search" data-ng-click="search()" data-boot-tooltip="true" title="{{trans('base::general.search_filter')}}">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button type="button" class="btn search" data-ng-click="gridReset()" data-boot-tooltip="true" title="{{trans('base::general.reset')}}">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td data-ng-if="noRecords" colspan="@{{heading.length + 1}}" class="no-data">{{trans('base::general.not_found')}}</td>
                        </tr>
                      
                        <tr data-ng-if="showRecords" data-ng-repeat="record in records track by $index" data-ng-show="showRecords" class="list-repeat">
                            <td class="center">@{{((currentPage - 1) * rowsPerPage) + $index +1}}</td>
                            <td> <a title="@{{record.title}}" href="{{url('admin/examgroups/videos')}}/@{{record.id}}" class="view-categories">@{{record.name}}</a>
                            </td>
                        <td>
                        <span class="img_title">
                                <img ng-if="record.group_image" src="@{{record.group_image}}" alt="" />
                                <img ng-if="!record.group_image" src="{{ url('contus/base/images/no-preview.png') }}" alt="" />
                         </span></td>
                            <td class="center">
                                <p>@{{record.order}}</p>
                            </td>
                            <td>
                                <span class="label label-success" ng-if="record.is_active == 1" style="cursor: pointer;" data-ng-click="groupCtrl.updateStatus(record)" title="{{trans('video::playlist.deactivate_playlist')}}" data-boot-tooltip="true">{{trans('video::playlist.message.active')}}</span>
                                <span class="label label-danger" ng-if="record.is_active != 1" style="cursor: pointer;" data-ng-click="groupCtrl.updateStatus(record)" title="{{trans('video::playlist.activate_playlist')}}" data-boot-tooltip="true">{{trans('video::playlist.message.inactive')}}</span>
                            </td>
                            <td>@{{ $root.getFormattedDate(record.created_at) }}</td>
                            <td class="action center">
                                <div id="st-trigger-effects" class="column edit_table_icon">
                                    <button data-boot-tooltip="true" data-effect="st-effect-18" data-intialize-sidebar title="View/Edit" data-ng-click="groupCtrl.getgroupEdit(record)" class="table_action">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <span ng-mouseover="getTooltip($event)" title="{{trans('base::general.delete')}}" data-toggle="modal" data-target="#deleteModal" ng-click="deleteSingleRecord(record.id)" class="tooltips delete_table_icon" data-boot-tooltip="true" data-original-title="">
                                    <i class="fa fa-trash-o"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('base::layouts.pagination')
        </div>
    </div>
</div>
<!-- To Edit the playlist  -->
<nav class="st-menu st-effect-18" id="menu-18">
    <div class="pop_over_continer">
        <form name="groupForm" method="POST" data-base-validator data-ng-submit="groupCtrl.examgroupsave($event, groupCtrl.group.id)" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="video_form add_form">
                <h5 data-ng-if="!groupCtrl.group.id">Add New Group</h5>
                <h5 data-ng-if="groupCtrl.group.id">Edit Group</h5>
                @include('base::partials.errors')
                <div class="form-group" data-ng-class="{'has-error': errors.name.has}">
                    <label class="control-label">
                        {{trans('video::playlist.group_name')}}
                        <span class="asterisk">*</span>
                    </label>
                    <input type="text" name="name" class="form-control" data-validation-name="Group Name" data-unique="@{{groupCtrl.uniqueRoute}}" data-ng-model="groupCtrl.group.name" placeholder="{{trans('video::playlist.group_name')}}" value="{{old('name')}}" />
                    <p class="help-block" data-ng-show="errors.name.has">@{{ errors.name.message }}</p>
                </div>
                  <div class="form-group" data-ng-class="{'has-error': errors.category_id.has}">
                    <label class="control-label">Sub Genre</label>

                    <ul data-ng-repeat="cat in groupCtrl.category">
                        <li>
                            <input name="collection_id" type="radio" data-validation-name="Exam Name" data-ng-model="groupCtrl.group.collection_id" value="@{{cat.id}}" class="radio_prod" />
                            @{{cat.title}}
                        </li>
                    </ul>
                    <p class="help-block" data-ng-show="errors.category_id.has">@{{ errors.category_id.message }}</p>
                </div>
                  <div class="form-group" data-ng-class="{'has-error': errors.order.has}">
                    <label class="control-label">
                        {{trans('video::playlist.group_order')}}
                        <span class="asterisk">*</span>
                    </label>
                    <input type="text" name="order" class="form-control" data-validation-name="Group Name" data-unique="@{{groupCtrl.uniqueRoute}}" data-ng-model="groupCtrl.group.order" placeholder="{{trans('video::playlist.group_order')}}" value="{{old('order')}}" />
                    <p class="help-block" data-ng-show="errors.order.has">@{{ errors.order.message }}</p>
                </div>
                <div class="form-group">
                    <div flow-object="existingFlowObject" flow-init="" flow-file-added="!!{png:1,gif:1,jpg:1,jpeg:1}[$file.getExtension()]" flow-files-submitted="$flow.upload()">
                        <div class="">
                            <p class="help-block" data-ng-show="errors.group_image.has">@{{ errors.group_image.message }}</p>
                            <hr class="soften" />
                            <div>
                                <div class="thumbnail" ng-hide="$flow.files.length">
                                    <img ng-if="groupCtrl.group.group_image" src="@{{groupCtrl.group.group_image}}" />
                                    <img ng-if="! groupCtrl.group.group_image" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" />
                                </div>
                                <div class="thumbnail" ng-show="$flow.files.length">
                                    <img flow-img="$flow.files[0]" />
                                </div>
                                <div>
                                    <a href="#" class="btn btn-primary upload_video" ng-hide="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">
                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                        Select image
                                    </a>
                                    <a href="#" class="btn btn-default " ng-show="$flow.files.length" flow-btn flow-attrs="{accept:'image/*'}">Change</a>
                                    <a href="#" class="btn btn-danger" ng-show="$flow.files.length || groupCtrl.group.group_image" ng-click="$flow.cancel();groupCtrl.group.group_image =''"> Remove </a>
                               
  <span  class="loaders" id="loader" style="display: none">
 <img src ="{{ url('contus/base/images/admin/loader.gif') }}" alt="ImageLoader" height="100" width="100">
                      				  </span>
                                </div>
                                <p class="intimation"> Only PNG,GIF,JPG files allowed.</p>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="group_image" id="group_image" data-ng-model="groupCtrl.group.group_image" value="{{old('group_image')}}" />
                </div>
                <div class="form-group">
                    <label class="control-label">{{ trans('video::videos.status') }} </label>
                    <select class="form-control" name="is_active" data-ng-model="groupCtrl.group.is_active">
                        <option value="1">{{ trans('video::videos.message.active') }}</option>
                        <option value="0">{{ trans('video::videos.message.inactive') }}</option>
                    </select>
                </div>
            </div>
            <div class="panel-footer clearfix">
                <button class="btn btn-primary pull-right submitbutton">{{trans('base::general.submit')}}</button>
                &nbsp;
                <span class="btn btn-danger pull-right mr10" data-ng-click="groupCtrl.closegroupEdit()">{{ trans('base::general.cancel') }}</span>
            </div>
        </form>
    </div>
</nav>