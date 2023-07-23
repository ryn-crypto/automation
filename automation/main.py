from instagrapi import Client
from instagrapi.types import Usertag, Location
import config

cl = Client()
cl.login(config.username, config.password)

followuser = ['duratect_id', 'uniglobe_indonesia', 'cpf1windowfilm', 'llumarindonesia']

# ambil id user
idUser = []
for i in range(len(followuser)):
   id = cl.user_id_from_username(followuser[i])
   idUser.append(id)
    
# tampilkan id user yang akan di follow
print(idUser);

# follow user
for i in range(len(idUser)):
   follow = cl.user_follow(idUser[i])
   print(follow)

# siapkan wadah media
mediaList = []
# ambil media dari id user
for i in range(len(idUser)):
   media = cl.user_medias(idUser[i], amount=250)
   mediaList.append(media)

# ambil id dari media
listMediaId = []
for i in range(len(mediaList)):
   for j in range(len(mediaList[i])):
      mediaId = (mediaList[i][j].id)
      listMediaId.append(mediaId)

# lihat id media yang akan di like
print(listMediaId)

for i in range(len(listMediaId)):
    cl.media_like(listMediaId[i])
