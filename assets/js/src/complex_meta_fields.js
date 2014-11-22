/**
 * Complex Meta Fields
 * http://eney.solutions/complex-meta-fields
 *
 * Copyright (c) 2014 Anton Korotkov
 * Licensed under the GPLv2+ license.
 */

(function (window, undefined) {
  'use strict';

  var cmf = angular
          
  .module( 'cmfApp', [] )
  
  .controller( 'cmfWorkspace', function( $scope ){
    $scope.fields = [
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
  } );

})(this);