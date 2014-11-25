/**
 * Complex Meta Fields
 * http://eney.solutions/complex-meta-fields
 *
 * Copyright (c) 2014 Anton Korotkov
 * Licensed under the GPLv2+ license.
 */

(function (window, undefined) {
  'use strict';
  
  //** Field Constructor */
  var _Field = function() {
    return {
      input: 'text',
      name: '',
      options: ''
    };
  };
  
  //** FieldSet Constructor */
  var _FieldSet = function() {
    return {
      show: true,
      name: 'New FieldSet', 
      post_type: 'post',
      options: [new _Field()]
    };
  };

  //** Start with Angular */
  var cmf = angular
  
  //** Create module */
  .module( 'cmfApp', ['slugifier'] )
  
  //** Create controller for Fields Builder */
  .controller( 'cmfWorkspace', function( $scope, $http ){
    
    $scope.is_loading = false;
    
    /**
     * GET FieldSets
     * @returns {undefined}
     */
    $scope.getFieldSets = function() {
      $scope.is_loading = true;
      $http.get( ajaxurl + '?action=cmf_get_fieldsets' ).success(function(data) {
        $scope.fieldsets = data;
        $scope.is_loading = false;
      });
    };
    
    /**
     * Add Field Set
     * @param {type} fieldsets
     * @returns {undefined}
     */
    $scope.addFieldSet = function( fieldsets ) {
      fieldsets.push(new _FieldSet());
    };
    
    /**
     * 
     * @param {type} fieldsets
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeFieldSet = function( fieldsets, item ) {
      if ( confirm( 'Sure?' ) ) fieldsets.splice(item, 1);
    };
    
    /**
     * Add new Field into field set
     * @param {type} options
     * @returns {undefined}
     */
    $scope.addField = function( options ) {
      options.push(new _Field());
    };
    
    /**
     * Remove Field from field set
     * @param {type} options
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeField = function( options, item ) {
      if ( confirm( 'Sure?' ) ) options.splice(item, 1);
    };
    
    /**
     * Check whether to show values intup for field or not
     * @param {type} option
     * @returns {Boolean}
     */
    $scope.fieldHasValues = function( option ) {
      return ['select', 'radio', 'checkbox'].indexOf( option.input ) !== -1;
    };
    
  })
  
  //** Create Controller for MetaBox */
  .controller( 'cmfMetaBox', function( $scope ){
    
    $scope.templates_url = cmfL10N.templates_url;
    
    $scope.fieldsets = [];
    
    $scope.initialize = function( args, data ) {
      $scope.fieldsets.push( args );
      console.log( $scope );
    };
    
    $scope.addFieldSet = function( fieldsets ) {
      console.log( $scope.fieldsets[0] );
      fieldsets.push( angular.copy( $scope.fieldsets[0] ) );
    };
    
  });

})(this);