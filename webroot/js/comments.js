/**
 * @fileoverview Comments Javascript
 * @author nakajimashouhei@gmail.com (Shohei Nakajima)
 */


/**
 * Comments Javascript
 *
 * @param {string} Controller name
 * @param {function($scope, NetCommonsWysiwyg)} Controller
 */
NetCommonsApp.controller('Comments',
    function($scope, NetCommonsWorkflow) {

      /**
       * tinymce
       *
       * @type {object}
       */
      $scope.workflow = NetCommonsWorkflow.new();
    });
