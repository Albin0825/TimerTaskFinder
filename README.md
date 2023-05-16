# TimerTaskFinder
Report how much time you have put on a task and what task that needs to be done first

# config.php
```php
// URL to your CodeIgniter root.
// http://example.com/
// WARNING: You MUST set this value!
$config['base_url'] = 'http://localhost:8080/projects/timertaskfinder';
```

# database.php
```php
// This file will contain the settings needed to access your database.
'hostname' => 'localhost',
'username' => 'root',
'password' => '',
'database' => 'timertaskfinder',
```

# DB
```sql
--
-- all the tables are not in use in the current build
--
timertaskfinder
├ user
│ ├ id          -- int(11) | PRIMARY
│ ├ username    -- varchar(255)
│ └ password    -- varchar(255)
├ userProject
│ ├ id          -- int(11) | PRIMARY
│ ├ userID      -- int(11)
│ └ projectID   -- int(11)
├ projectTask
│ ├ id          -- int(11) | PRIMARY
│ ├ projectID   -- int(11)
│ └ taskID      -- int(11)
├ task --task and project is the same table
│ ├ id          -- int(11) | PRIMARY
│ ├ title       -- varchar(255)
│ ├ description -- longtext
│ ├ eta         -- double
│ ├ time        -- double
│ ├ updateDate  -- datetime
│ ├ priority    -- double
│ └ module      -- varchar(255)
└ report
  ├ id          -- int(11) | PRIMARY
  ├ userID      -- int(11)
  ├ taskID      -- int(11)
  ├ time        -- double
  └ description -- longtext
```
