# TimerTaskFinder
Report how much time you have put on a task and what task that needs to be done first

# config.php
```
URL to your CodeIgniter root.
http://example.com/
WARNING: You MUST set this value!
$config['base_url'] = '';
```

# database.php
```
This file will contain the settings needed to access your database.
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'timertaskfinder',
```

# DB
```
timertaskfinder
├ task
│ ├ id          - int(11)
│ ├ title       - varchar(255)
│ ├ description - longtext
│ ├ updateDate  - datetime
│ └ priority    - double
└ Reports
  ├ id          - int(11)
  ├ taskID      - int(11)
  └ description - longtext
```
