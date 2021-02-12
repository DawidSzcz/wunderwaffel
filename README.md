# WUNDERWAFFEL
> To make waffel wunder again

### Access
App is deplyed on AWS. It uses RDS + EC2
It can be accessed: http://ec2-3-121-201-104.eu-central-1.compute.amazonaws.com/wunderwaffel/register

Let me introduce to you a wonderful  project which makes every waffle enthusiasts’ dreams come true.

The application contains the most beautiful form that you have ever seen.
### IN TWO VERSIONS.


I wasn't capable of deciding which design appeal better to my clients, so I created them **both**:
- Single site form divided into steps with the fancy collapsable  widget from Bootstrap
- Form divided into separate steps with a dedicated view for each. Just as in the specification (the ugly truth is that it also uses a single view, but uses js to pretend that it is not)

### AB tests
A simple AB test to choose the winner form was implemented.
To see both form versions please use incognito mode or kill your session and refresh the page.
### Admin Page (credentials: admin/admin)
Additionally, I added an admin page when an authenticated user can manage registered clients, and see the current result of AB test.


### Technologies and patterns
- PHP7.4, Yi
- Active record as ORM
- Gii to generate admin panel forms, controllers, views etc.
- db schema created in migrations
- composer to download suitable dependencies
- bootstrap components, css, js
- xdebug + yii profiler during coding
- WunderApi connector injected into app from config
- basic auth to log into admin panel (added as behavior to admin controller)
- Unsaved form persisted  in DbSession
- AB tests managed with the use of session
- DB url and credentials loaded from env variable (DATABASE_URL)

### Possible improvements and things I am ashamed of
- The make it easier to perform the ab tests  the form which should be separated in multiple steps was pushed to a single view.
- javaScript which operates on this form is terrible. It even uses timeouts to wait for validations. In real life, the view would be separated into steps, according to specification.
-  not a single test was written due to lack of time (WunderWaffelForm definitly should be tested in the first place)
- admin user is stored in array in code. This was created only as a proove of concept and ignore security concerns
- ABTest results should be statistically analyzed to be meaningful
- ActiveRecord was used to speed up the work process. I definitely prefer repositories + factories over DAO
- use_strict_mode should be set in php ini
- User input should be purified in admin panel to avoid XSS
- Debug mode must be switched off
