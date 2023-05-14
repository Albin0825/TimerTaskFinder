# TimerTaskFinder
Report how much time you have put on a task and what task that needs to be done first

# config.php
```
URL to your CodeIgniter root.
http://example.com/
WARNING: You MUST set this value!
$config['base_url'] = 'http://localhost:8080/projects/timertaskfinder';
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
├ user
│ ├ id          - int(11) | PRIMARY
│ ├ username    - varchar(255)
│ └ password    - varchar(255)
├ report
│ ├ id          - int(11) | PRIMARY
│ ├ userID      - int(11)
│ ├ taskID      - int(11)
│ ├ time        - double
│ └ description - longtext
└ task
  ├ id          - int(11) | PRIMARY
  ├ title       - varchar(255)
  ├ description - longtext
  ├ updateDate  - datetime
  └ priority    - double
```
