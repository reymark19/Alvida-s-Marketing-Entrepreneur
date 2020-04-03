<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.
  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at
      https://www.apache.org/licenses/LICENSE-2.0
  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="System Max Global Corp.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>System Max Global Corp.</title>
    <?php if (ENVIRONMENT == 'development'): ?>
      <meta name="google-signin-client_id" content="232786101880-bu33cakq6v5epvkpjuq7g2q42ckr809m.apps.googleusercontent.com">
    <?php else: ?>
      <meta name="google-signin-client_id" content="224453956104-9irgaq75sj9ukgfjltbek81mk6mue7kk.apps.googleusercontent.com">
    <?php endif ?>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?php echo base_url(); ?>/images/favicon.ico" type="image/x-icon">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="<?php echo base_url(); ?>/images/favicon.ico">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico">

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/mdl/material.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/lib/getmdl-select-master/getmdl-select.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/common.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dashboard/styles.css">

    
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>

  <script src="<?php echo base_url('assets/lib/jquery/js/jquery-1.12.4.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery/js/jquery.tabletojson.min.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery/js/jquery.print.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/jquery-ui/jquery-ui.min.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/mdl/material.min.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/getmdl-select-master/getmdl-select.min.js')?>"></script>
  <script src="<?php echo base_url('assets/lib/hammer/hammer.js')?>"></script>

  </head>