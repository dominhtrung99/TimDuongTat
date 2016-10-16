(function(scope) {

  var _toString = Object.prototype.toString;
  function isDate(o)   { return '[object Date]'   == _toString.call(o); }
  function isRegExp(o) { return '[object RegExp]' == _toString.call(o); }
  
  var Cookie = {
    
    get: function get(name) {
      return Cookie.has(name) ? Cookie.list()[name] : null;
    },

    has: function has(name) {
      return new RegExp("(?:;\\s*|^)" + encodeURIComponent(name) + '=').test(document.cookie);
    },
    

    list: function list(nameRegExp) {
      var pairs = document.cookie.split(';'), pair, result = {};
      for (var index = 0, len = pairs.length; index < len; ++index) {
        pair = pairs[index].split('=');
        pair[0] = pair[0].replace(/^\s+|\s+$/, '');
        if (!isRegExp(nameRegExp) || nameRegExp.test(pair[0]))
          result[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
      }
      return result;
    },
    

    remove: function remove(name, options) {
      var opt2 = {};
      for (var key in (options || {})) opt2[key] = options[key];
      opt2.expires = new Date(0);
      opt2.maxAge = -1;
      return Cookie.set(name, null, opt2);
    },
    

    set: function set(name, value, options) {
      options = options || {};
      var def = [encodeURIComponent(name) + '=' + encodeURIComponent(value)];
      if (options.path) def.push('path=' + options.path);
      if (options.domain) def.push('domain=' + options.domain);
      var maxAge = 'maxAge' in options ? options.maxAge :
        ('max_age' in options ? options.max_age : options['max-age']), maxAgeNbr;
      if ('undefined' != typeof maxAge && 'null' != typeof maxAge && (!isNaN(maxAgeNbr = parseFloat(maxAge))))
        def.push('max-age=' + maxAgeNbr);
      var expires = isDate(options.expires) ? options.expires.toUTCString() : options.expires;
      if (expires) def.push('expires=' + expires);
      if (options.secure) def.push('secure');
      def = def.join(';');
      document.cookie = def;
      return def;
    },
    
    test: function test() {
      var key = '70ab3d396b85e670f25b93be05e027e4eb655b71', value = 'Élodie Jaubert';
      Cookie.remove(key);
      Cookie.set(key, value);
      var result = value == Cookie.get(key);
      Cookie.remove(key);
      return result;
    }
  };
  scope.Cookie = Cookie;
})(window);
/* /COOKIES HELPER */ 