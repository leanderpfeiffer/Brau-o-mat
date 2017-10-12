import sys, os, time

def AktuelleTemperatur():
    file=open("/sys/devices/w1_bus_master1/28-051670b0a3ff/w1_slave")
    filecontent = file.read()
    file.close
    temprature = float(filecontent[-6:-1] )/ 1000 
    return temprature

def TextdateiSchreiben(temperatur):
    file = open("temperatur.txt","w")
    file.write(str(temperatur))
    file.close()


while 1<2:
    tData = AktuelleTemperatur()
    TextdateiSchreiben(tData)
    time.sleep(1)
            
