use CGI;
use CGI::Session;
use CGI::Carp qw (fatalsToBrowser);
use Crypt::Password;

##---------------------------- MAIN ---------------------------------------

my $q;
if(authenticate_user()) {
    send_to_main();   
    }
else {
    send_to_login_error();
    }    
###########################################################################

###########################################################################
sub authenticate_user {
    $q = new CGI;
    my $user = $q->param("user");
    my $password = $q->param("password");    
    open DATA, "</srv/www/cgi-bin/jadrn000/sessions_cookies/passwords.dat" 
        or die "Cannot open file.";
    @file_lines = <DATA>;
    close DATA;

    $OK = 0; #not authorized

    foreach $line (@file_lines) {
        chomp $line;
        ($stored_user, $stored_pass) = split /=/, $line;    
    if($stored_user eq $user && check_password($stored_pass, $password)) {
        $OK = 1;
        last;
        }
    }
          
    return $OK;
    }
###########################################################################

###########################################################################
sub send_to_login_error {
    print <<END;
Content-type:  text/html

<html>
<head>
    <meta http-equiv="refresh" 
        content="0; url=http://jadran.sdsu.edu/~jadrn000/proj1_examples/login/error.html" />
</head><body></body>
</html>

END
    }  
    
###########################################################################
      
###########################################################################
sub send_to_main {
# args are DRIVER, CGI OBJECT, SESSION LOCATION
# default for undef is FILE, NEW SESSION, /TMP 
# for login.html, don't look for any existing session.
# Always start a new one.  Send a cookie to the browser.
# Default expiration is when the browser is closed.
# WATCH YOUR COOKIE NAMES! USE JADRNXXX_SID  
    my $session = new CGI::Session(undef, undef, {Directory=>'/tmp'});
    $session->expires('+1d');
    my $cookie = $q->cookie(jadrn000SID => $session->id);
    print $q->header( -cookie=>$cookie ); #send cookie with session ID to browser    
    my $sid = $session->id;
    print <<END;
<html>
<head>
    
</head>
<body>
<h2>Content goes here, this is the landing page</h2>
<p>
<ul>
<li><a href="/perl/jadrn000/sessions_cookies/page1.cgi">First Page</a></li>
<li><a href="/perl/jadrn000/sessions_cookies/page2.cgi">Second Page</a></li>
<li><a href="/perl/jadrn000/sessions_cookies/page3.cgi">Third Page</a></li>
<li><a href="/perl/jadrn000/sessions_cookies/page4.cgi">Fourth Page</a></li>
</ul>
</p>
<p>
This is the page that is protected.<br />
The session ID is $sid
</p>

<br />
<a href="/perl/jadrn000/sessions_cookies/logout.cgi">Logout Now</a>
</body>
</html>

END
}
###########################################################################    
    




