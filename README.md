Simple comparision on different fibonacci implementation.

```shell
php -v
PHP 5.6.29-1+deb.sury.org~xenial+1 (cli) 
Copyright (c) 1997-2016 The PHP Group
Zend Engine v2.6.0, Copyright (c) 1998-2016 Zend Technologies
    with Zend OPcache v7.0.6-dev, Copyright (c) 1999-2016, by Zend Technologies
```

| Algorithm | # samples | time | description |
| --------- |:---------:| :----:| ----------|
| Simple Recursive | 40 | 60.4387s | took too long for such a small number |
| Improved Recursive | 21,500 | 0.5599s | cap reached, larger number: "Segmentation fault (core dumped)" |
| No Recursion With Array | 200,000 | 69.7008s | memory leak |
| No Recursion With Array Improved | 200,000 | 52.3043s | less performed than callback, but much simpler code |
| **Callback** | 200,000 | 44.8545s | perfect performance, complex code |

```shell
php -v
PHP 7.1.0 (cli) (built: Dec 14 2016 15:01:30) ( NTS )
Copyright (c) 1997-2016 The PHP Group
Zend Engine v3.1.0-dev, Copyright (c) 1998-2016 Zend Technologies
```

| Algorithm | # samples | time | description |
| --------- |:---------:| :----:| ---------- |
| Simple Recursive | 40 | 15.2639s | significant improve for small numbers |
| Simple Recursive | 43 | 83.0023s | still same issue |
| Improved Recursive | 600,000 | 0.1107s | larger numbers: memory allowcation problem
| No Recursion With Array | 600,000 | 0.0786s | |
| **No Recursion With Array Improved** | 600,000 | 0.0177s | |
| Callback | 600,000 | 0.3126s | |
