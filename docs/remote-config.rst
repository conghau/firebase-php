#############
Remote Config
#############

Change the behavior and appearance of your app without publishing an app update.

Firebase Remote Config is a cloud service that lets you change the behavior and appearance of your app without
requiring users to download an app update. When using Remote Config, you create in-app default values that
control the behavior and appearance of your app.

Before you start, please read about Firebase Remote Config in the official documentation:

- `Firebase Remote Config <https://firebase.google.com/docs/remote-config/>`_

.. note::
    The implementation in this library is in its very early stages and has been created at the
    announcement day of the Remote Config REST API (see the
    `Announcement post in the Firebase Blog <https://firebase.googleblog.com/2018/03/announcing-remote-config-rest-api.html>`_). It
    currently only supports getting and setting the raw configuration, and will be extended over time.

****************
Before you begin
****************

For Firebase projects created before the March 7, 2018 release of the Remote Config REST API, you must enable the API in the Google APIs console.

1. Open the `Firebase Remote Config API page <https://console.developers.google.com/apis/api/firebaseremoteconfig.googleapis.com/overview?project=_>`_ in the Google APIs console.
2. When prompted, select your Firebase project. (Every Firebase project has a corresponding project in the Google APIs console.)
3. Click Enable on the Firebase Remote Config API page.

You can work with your Firebase application's Remote Config by invoking the ``getRemoteConfig()``
method of your Firebase instance:

.. code-block:: php

    use Kreait\Firebase;

    $firebase = (new Firebase\Factory())->create();
    $remoteConfig = $firebase->getRemoteConfig();

******************************
Get the Remote Config Template
******************************

.. code-block:: php

    $template = $remoteConfig->getTemplate();
    $rawData = $template->getRawData();

**********************************
Publish the Remote Config Template
**********************************

.. code-block:: php

    use Kreait\Firebase;

    $updateRequest = $template->withNewRawData([/* your updated template data */]);
    $updatedTemplate = $remoteConfig->publishTemplate($updateRequest);
