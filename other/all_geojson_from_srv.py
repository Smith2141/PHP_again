import urllib2

urls = [ "http://10.19.206.50/share/SKM_TP_20200102.json",
"http://10.19.206.50/share/SKM_TP_20200101.json",
"http://10.19.206.50/share/SKM_TP_20200103.json",
"http://10.19.206.50/share/SKM_TP_20200104.json",
"http://10.19.206.50/share/SKM_TP_20200105.json",
"http://10.19.206.50/share/SKM_TP_20200106.json",
"http://10.19.206.50/share/SKM_TP_20200107.json",
"http://10.19.206.50/share/SKM_TP_20200108.json",
"http://10.19.206.50/share/SKM_TP_20200109.json",
"http://10.19.206.50/share/SKM_TP_20200110.json",
"http://10.19.206.50/share/SKM_TP_20200111.json",
"http://10.19.206.50/share/SKM_TP_20200112.json",
"http://10.19.206.50/share/SKM_TP_20200113.json",
"http://10.19.206.50/share/SKM_TP_20200114.json",
"http://10.19.206.50/share/SKM_TP_20200115.json",
"http://10.19.206.50/share/SKM_TP_20200116.json",
"http://10.19.206.50/share/SKM_TP_20200117.json",
"http://10.19.206.50/share/SKM_TP_20200118.json",
"http://10.19.206.50/share/SKM_TP_20200119.json",
"http://10.19.206.50/share/SKM_TP_20200120.json",
"http://10.19.206.50/share/SKM_TP_20200121.json",
"http://10.19.206.50/share/SKM_TP_20200122.json",
"http://10.19.206.50/share/SKM_TP_20200123.json",
"http://10.19.206.50/share/SKM_TP_20200124.json",
"http://10.19.206.50/share/SKM_TP_20200125.json",
"http://10.19.206.50/share/SKM_TP_20200126.json",
"http://10.19.206.50/share/SKM_TP_20200127.json",
"http://10.19.206.50/share/SKM_TP_20200128.json",
"http://10.19.206.50/share/SKM_TP_20200129.json",
"http://10.19.206.50/share/SKM_TP_20200130.json",
"http://10.19.206.50/share/SKM_TP_20200131.json",
"http://10.19.206.50/share/SKM_TP_20200201.json",
"http://10.19.206.50/share/SKM_TP_20200202.json",
"http://10.19.206.50/share/SKM_TP_20200203.json",
"http://10.19.206.50/share/SKM_TP_20200204.json",
"http://10.19.206.50/share/SKM_TP_20200205.json",
"http://10.19.206.50/share/SKM_TP_20200206.json",
"http://10.19.206.50/share/SKM_TP_20200207.json",
"http://10.19.206.50/share/SKM_TP_20200208.json",
"http://10.19.206.50/share/SKM_TP_20200209.json",
"http://10.19.206.50/share/SKM_TP_20200210.json",
"http://10.19.206.50/share/SKM_TP_20200211.json",
"http://10.19.206.50/share/SKM_TP_20200212.json",
"http://10.19.206.50/share/SKM_TP_20200213.json",
"http://10.19.206.50/share/SKM_TP_20200214.json",
"http://10.19.206.50/share/SKM_TP_20200215.json",
"http://10.19.206.50/share/SKM_TP_20200216.json",
"http://10.19.206.50/share/SKM_TP_20200217.json",
"http://10.19.206.50/share/SKM_TP_20200218.json",
"http://10.19.206.50/share/SKM_TP_20200219.json",
"http://10.19.206.50/share/SKM_TP_20200220.json",
"http://10.19.206.50/share/SKM_TP_20200221.json",
"http://10.19.206.50/share/SKM_TP_20200222.json",
"http://10.19.206.50/share/SKM_TP_20200223.json",
"http://10.19.206.50/share/SKM_TP_20200224.json",
"http://10.19.206.50/share/SKM_TP_20200225.json",
"http://10.19.206.50/share/SKM_TP_20200226.json",
"http://10.19.206.50/share/SKM_TP_20200227.json",
"http://10.19.206.50/share/SKM_TP_20200228.json",
"http://10.19.206.50/share/SKM_TP_20200229.json",
"http://10.19.206.50/share/SKM_TP_20200301.json",
"http://10.19.206.50/share/SKM_TP_20200302.json"
]

for url in urls:
	file_name = ".\\in\\" + url.split('/')[-1]
	u = urllib2.urlopen(url)
	f = open(file_name, 'wb')
	meta = u.info()
	file_size = int(meta.getheaders("Content-Length")[0])
	print "Downloading: %s Bytes: %s" % (file_name, file_size)

	file_size_dl = 0
	block_sz = 8192
	while True:
		buffer = u.read(block_sz)
		if not buffer:
			break

		file_size_dl += len(buffer)
		f.write(buffer)
		status = r"%10d  [%3.2f%%]" % (file_size_dl, file_size_dl * 100. / file_size)
		status = status + chr(8)*(len(status)+1)
		print status,

	f.close()