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
      input: '',
      name: '',
      options: ''
    };
  }
  
  var _FieldSet = function() {
    return {
      name: 'New Field Set',
      post_type: 'post',
      options: []
    };
  }

  //** Start with Angular */
  var cmf = angular
  
  //** Create module */
  .module( 'cmfApp', [] )
  
  //** Create controller */
  .controller( 'cmfWorkspace', function( $scope ){
    $scope.fieldsets = [
      {
        name: 'Sub Company',
        post_type: 'post',
        options: [
          {
            input: 'text',
            name: 'Company Name'
          },
          {
            input: 'text',
            name: 'CEO'
          },
          {
            input: 'select',
            name: 'Type',
            options: 'big:Big,small:Small'
          }
        ]
      },
      {
        name: 'Authors',
        post_type: 'page',
        options: [
          {
            input: 'text',
            name: 'Author Name'
          },
          {
            input: 'text',
            name: 'Author Sirname'
          }
        ]
      }
    ];
    
    /**
     * Add Field Set
     * @param {type} fieldsets
     * @returns {undefined}
     */
    $scope.addFieldSet = function( fieldsets ) {
      fieldsets.push(new _FieldSet());
    }
    
    /**
     * 
     * @param {type} fieldsets
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeFieldSet = function( fieldsets, item ) {
      if ( confirm( 'Sure?' ) ) fieldsets.splice(item, 1);
    }
    
    /**
     * Add new Field into field set
     * @param {type} options
     * @returns {undefined}
     */
    $scope.addField = function( options ) {
      options.push(new _Field());
    }
    
    /**
     * Remove Field from field set
     * @param {type} options
     * @param {type} item
     * @returns {undefined}
     */
    $scope.removeField = function( options, item ) {
      if ( confirm( 'Sure?' ) ) options.splice(item, 1);
    }
    
    /**
     * Check whether to show values intup for field or not
     * @param {type} option
     * @returns {Boolean}
     */
    $scope.fieldHasValues = function( option ) {
      return ['select', 'radio', 'checkbox'].indexOf( option.input ) !== -1;
    }
    
    
  } );

})(this);