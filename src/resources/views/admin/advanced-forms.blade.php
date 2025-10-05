@extends('layouts.admin')

@section('title', 'Advanced Form Elements')

{{-- @section('page-pretitle', 'Forms') --}}
@section('page-title', 'Advanced Form Elements')
{{-- @section('page-description', 'Extended form components with advanced features and validation') --}}

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Advanced Forms</li>
@endsection

{{-- @section('page-actions')
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
        <x-icon name="plus" class="me-2" />
        Back to Dashboard
    </a>
@endsection --}}

@section('content')
  <div class="row row-cards">
      <div class="col-12">
          <x-card title="Toggle Switches">
              <x-form.toggle
                  name="notifications"
                  label="Push Notifications"
                  description="Enable push notifications for this account"
                  :checked="true"
              />

              <x-form.toggle
                  name="sms"
                  label="SMS Notifications"
                  size="sm"
              />

              <x-form.toggle
                  name="email_marketing"
                  label="Email Marketing"
                  :disabled="true"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="Input Groups">
              <x-form.input-group
                  name="website"
                  label="Website URL"
                  prepend="https://"
                  append=".com"
                  placeholder="yoursite"
              />

              <x-form.input-group
                  name="email_domain"
                  label="Email"
                  prepend="@"
                  placeholder="username"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="Input Masks">
              <x-form.input-mask
                  name="phone"
                  label="Phone Number"
                  mask="phone"
              />

              <x-form.input-mask
                  name="birth_date"
                  label="Birth Date"
                  mask="date"
              />

              <x-form.input-mask
                  name="time"
                  label="Time"
                  mask="time"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="Range Sliders">
              <x-form.range
                  name="volume"
                  label="Volume"
                  :min="0"
                  :max="100"
                  :value="50"
              />

              <x-form.range
                  name="quality"
                  label="Quality"
                  :min="1"
                  :max="10"
                  :value="8"
                  :show-value="false"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="Color Picker">
              <x-form.color-picker
                  name="primary_color"
                  label="Primary Color"
                  value="#206bc4"
              />
          </x-card>
      </div>

      <div class="col-12">
          <x-card title="Select Groups">
              <x-form.select-group
                  name="programming_language"
                  label="Programming Language"
                  :options="[
                      'html' => ['text' => 'HTML', 'icon' => 'code'],
                      'css' => ['text' => 'CSS', 'icon' => 'palette'],
                      'js' => ['text' => 'JavaScript', 'icon' => 'brand-javascript'],
                      'php' => ['text' => 'PHP', 'icon' => 'brand-php']
                  ]"
                  style="pills"
                  selected="php"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="File Upload">
              <x-form.file-upload
                  name="avatar"
                  label="Profile Picture"
                  accept="image/*"
                  hint="Upload JPG, PNG or GIF files"
              />

              <x-form.file-upload
                  name="documents"
                  label="Documents"
                  :multiple="true"
                  accept=".pdf,.doc,.docx"
              />
          </x-card>
      </div>

      <div class="col-md-6">
          <x-card title="Date Picker">
              <x-form.date-picker
                  name="start_date"
                  label="Start Date"
                  value="{{ date('Y-m-d') }}"
              />

              <x-form.date-picker
                  name="inline_date"
                  label="Inline Date Picker"
                  :inline="true"
              />
          </x-card>
      </div>

      <div class="col-12">
          <x-card title="Tags Input">
              <x-form.tags-input
                  name="skills"
                  label="Skills"
                  :value="['Laravel', 'Vue.js', 'PHP']"
                  placeholder="Add skills..."
              />
          </x-card>
      </div>

      <div class="col-12">
          <x-card title="Progress Indicators">
              <x-progress :value="38" label="Profile Completion" />
              <x-progress :value="72" color="success" :striped="true" />
              <x-progress :value="45" color="warning" :animated="true" size="sm" />
          </x-card>
      </div>
  </div>
@endsection
