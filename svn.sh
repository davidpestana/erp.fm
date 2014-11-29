svn add --depth=empty app app/cache app/logs app/config web

svn propset svn:ignore "vendor" .
svn propset svn:ignore "bootstrap*" app/
svn propset svn:ignore "parameters.yml" app/config/
svn propset svn:ignore "*" app/cache/
svn propset svn:ignore "*" app/logs/

svn propset svn:ignore "bundles" web
svn ci -m "commit basic Symfony ignore list (vendor, app/bootstrap*, app/config/parameters.yml, app/cache/*, app/logs/*, web/bundles)"
