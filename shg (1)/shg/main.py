import os
import cgi
import urllib
from google.appengine.ext import ndb
from google.appengine.api import images
import jinja2
import Cookie
import webapp2




JINJA_ENVIRONMENT = jinja2.Environment(
loader=jinja2.FileSystemLoader(os.path.join(os.path.dirname(__file__))),
    extensions=['jinja2.ext.autoescape'])

cookie = Cookie.SimpleCookie()

def savelogin(login):
    cookie["login"] = login
    cookie["login"]['expires'] = 1*1*3*60*60
def loadlogin():
    if not cookie.output():
        return 'Guest'
    else:    
        return cookie["login"].value
    
def loadlogout():
    cookie["login"] = 'Guest'
        
def user_key(user_name):
    return ndb.Key('userkey', user_name)

def game_key(game_name):
    return ndb.Key('gamename', game_name)

def trad_key(trad_key):
    return ndb.Key('tradkey', trad_key)

def wish_key(wish_key):
    return ndb.Key('wishkey', wish_key)

class userdb(ndb.Model):
    username = ndb.StringProperty()
    password = ndb.StringProperty()
    email = ndb.StringProperty()
    phone = ndb.StringProperty()
    

class Usergame(ndb.Model):
    """Models a Guestbook entry with an author, content, avatar, and date."""
    username = ndb.StringProperty()
    gamename = ndb.StringProperty()
    intro = ndb.TextProperty()
    img = ndb.BlobProperty()
    tyle = ndb.StringProperty()
    date = ndb.DateTimeProperty(auto_now_add=True)
    avail = ndb.StringProperty()
    
class Trading(ndb.Model):
    requester = ndb.StringProperty()
    provider = ndb.StringProperty()
    req_game = ndb.StringProperty()
    pro_game = ndb.StringProperty()
    completion = ndb.StringProperty()
    
class Wishlist(ndb.Model):
    username = ndb.StringProperty()
    gamename = ndb.StringProperty()
    img = ndb.BlobProperty()
    avail = ndb.StringProperty()
    
class login(webapp2.RequestHandler):
    def get(self):
        login = loadlogin()
        template = JINJA_ENVIRONMENT.get_template('login.html')
        template_values = {
                'login_name': login
                }
        self.response.write(template.render(template_values))
        
    def post(self):
        username = self.request.get('username')
        password = self.request.get('password')
        check = '0'
        
        userdbs_query = userdb.query(ancestor=user_key(username)).order(-userdb.username)
        userdbs = userdbs_query.fetch(10)
        userdbb = userdb(parent=user_key(username)) 

        
        for userdbb in userdbs:
            if userdbb.username == username and userdbb.password == password:
                savelogin(userdbb.username)
                self.redirect('/')
                
                check = '1'
                
            elif userdbb.username == username and userdbb.password != password:
                template = JINJA_ENVIRONMENT.get_template('login.html')
                template_values = {'error': 'Wrong password!'}
                self.response.write(template.render(template_values))
                check = '1'
        
        if check == '0':    
            template = JINJA_ENVIRONMENT.get_template('login.html')
            template_values = {'error': 'No such user!'}
            self.response.write(template.render(template_values))
                
class logout(webapp2.RequestHandler):
    def get(self):
        loadlogout()
        self.redirect('/')
                    
class Usereg(webapp2.RequestHandler):
    def get(self):
        template = JINJA_ENVIRONMENT.get_template('userreg.html')
        self.response.write(template.render())
        
    def post(self):
        username = self.request.get('username')
        check = '0'
       
        userdbs_query = userdb.query(ancestor=user_key(username)).order(-userdb.username)
        userdbs = userdbs_query.fetch(10)
        
        userdbb = userdb(parent=user_key(username)) 

        
        for userdbb in userdbs:
            if userdbb.username == username or userdbb.username == 'Guest':
                template = JINJA_ENVIRONMENT.get_template('userreg.html')
                template_values = {'error': 'username already used'}
                self.response.write(template.render(template_values))
                check = '1'
        
        if check == '0':
            userdbb.username = self.request.get('username')
            userdbb.password = self.request.get('password')
            userdbb.email = self.request.get('email')
            userdbb.phone = self.request.get('phone')  
            userdbb.put()
            
            template = JINJA_ENVIRONMENT.get_template('userreg.html')
            template_values = {'error': 'reg success'}
            self.response.write(template.render(template_values))
            
class wishlist(webapp2.RequestHandler):
    def get(self):
            username = loadlogin()
            
            wish_query = Wishlist.query(ancestor=wish_key(username)).order(-Wishlist.username)
            wish = wish_query.fetch(10)
            
            wishl = Wishlist(parent=wish_key(username))
            
            template = JINJA_ENVIRONMENT.get_template('wishlist.html')
            template_values = {
                'login_name': username,
                'wish': wish,
            }
            self.response.write(template.render(template_values))
            
    def post(self):
            username = loadlogin()
            gname = self.request.get('gname')
            
            wish_query = Wishlist.query(ancestor=wish_key(username)).order(-Wishlist.username)
            wish = wish_query.fetch(10)
            wishl = Wishlist(parent=wish_key(username))
            
            wishl.username = username
            wishl.gamename = gname
            art = self.request.get('image')
            wishl.img = art
            wishl.avail = "unavail"
            
            wishl.put()
            
            
            template = JINJA_ENVIRONMENT.get_template('wishlist.html')
            template_values = {
                'login_name': username,
                'wish': wish, 
            }
            self.response.write(template.render(template_values))
            
class upload(webapp2.RequestHandler):
    def get(self):
            username = loadlogin()
            
            usgamess_query = Usergame.query(ancestor=game_key(username)).order(-Usergame.date)
            usgamess = usgamess_query.fetch(10)
            
            usgame = Usergame(parent=game_key(username))
            
            template = JINJA_ENVIRONMENT.get_template('upload.html')
          
            """for usgamee in usgamess:
                self.response.out.write('<div><img src="/img?img_id=%s"></img>' % usgamee.key.urlsafe())
                self.response.out.write('<blockquote>%s</blockquote></div>' % usgamee.date)"""
            self.response.write(template.render())
            
    def post(self):
            username = loadlogin()
            gname = self.request.get('gname')
            gk = username + "_" + gname
            
            usgame = Usergame(parent=game_key(username))
            
            usgame.username = username
            usgame.gamename = self.request.get('gname')
            
            act = self.request.get('image')
            usgame.img = act
            usgame.tyle = str(self.request.get_all('sel'))
            usgame.intro = self.request.get('comment')
            
            usgame.put()
            
            self.redirect('/')

class Detail(webapp2.RequestHandler):
    """Handle detail of the game"""
    def get(self):

        gameid = self.request.get('game')
        user = Usergame.query(Usergame.key.id() == gameid).get()
        username = user.username
        template_values = {
            'gameid' : gameid,
            # 'owner' : username,
        }
        template = JINJA_ENVIRONMENT.get_template('detail.html')
        self.response.write(template.render(template_values))


class Image(webapp2.RequestHandler):
    def get(self):
        ug_key = ndb.Key(urlsafe=self.request.get('img_id'))
        usgame = ug_key.get()
        if usgame.img:
            self.response.headers['Content-Type'] = 'image/png'
            self.response.out.write(usgame.img)
        else:
            self.response.out.write('No image')   
    
class MainHandler(webapp2.RequestHandler):
    def get(self):
        login = loadlogin() 

        usgamess_query = Usergame.query().order(-Usergame.date)
        usgamess = usgamess_query.fetch(10)
            
        usgame = Usergame(parent=game_key(login))
        
        template = JINJA_ENVIRONMENT.get_template('home.html')
        template_values = {
                'login_name': login,
                'usgamess': usgamess,
                }
        self.response.write(template.render(template_values))
        
    def post(self):
        login = loadlogin()
        search = self.request.get('search')
        if search == "action":
            gstr = "[u'Action']"
        elif search == "adventurn":
            gstr = "[u'Aadventurn']"
        elif search == "leisure":
            gstr = "[u'Leisure']"
        
        
        usgamess_query = Usergame.query(Usergame.tyle == gstr).order(-Usergame.date)
        usgamess = usgamess_query.fetch(10)
            
        usgame = Usergame(parent=game_key(login))
        
        template = JINJA_ENVIRONMENT.get_template('home.html')
        template_values = {
                'login_name': login,
                'usgamess': usgamess,
                }
        self.response.write(template.render(template_values))
    
   
        
app = webapp2.WSGIApplication([
    ('/', MainHandler),
    ('/reg', Usereg),
    ('/sign',login),
    ('/out', logout),
    ('/up', upload),
    ('/img', Image),
    ('/wish', wishlist),
    ('/detail',Detail),
], debug=False)
