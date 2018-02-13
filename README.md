## Installation

`composer require ethical-jobs/ethical-jobs-sdk`

Include the service provider and facade in you `config/app.php` file 

`EthicalJobs\SDK\Laravel\ServiceProvider::class`

`'EthicalJobs' => EthicalJobs\SDK\Laravel\ApiFacade::class,`

## Making Requests

There are many ways to access api resources, following are some examples:

```php
// GET /jobs
EthicalJobs::get(['status' => 'APPROVED']);

// GET /jobs/drafts
EthicalJobs::get('/jobs/drafts', ['status' => 'APPROVED']);

// GET /jobs/drafts
EthicalJobs::resource('jobs')->get('/drafts', ['status' => 'APPROVED']);

// GET /jobs/214
EthicalJobs::resource('jobs')->get('214');

// GET /jobs/214
EthicalJobs::resource('jobs')->get('/214');

// GET /jobs/214
EthicalJobs::get('/jobs/214');

// GET /jobs { status: APPROVED, expired: false }
EthicalJobs::resource('jobs')->approved();

// GET /jobs { expired: true }
EthicalJobs::resource('jobs')->expired();

// POST /jobs { ... }
EthicalJobs::post('/jobs', ['title' => 'React Developer', 'description' => 'We are looking for...']);

// PATCH /jobs/214 { title: 'React Developer' }
EthicalJobs::resource('jobs')->patch('214', ['title' => 'React Developer']);
```

## Responses

Responses are returned as `Illuminate\Support\Collection`s if there are no results an empty collection is returned.

In the future the results will be returned from an extended `EthicalJobs\SDK\Collection` class with helper functions to select results from our normalized api responses.

`$collection->entities('jobs');`