import sys, os, time

def AktuelleTemperatur():
    file=open("/sys/bus/w1/devices/28-041671e643ff/w1_slave")
    filecontent = file.read()
    file.close
    temprature = float(filecontent[-6:-1] )/ 1000 
    
    return temprature
runTime = int(input("Wie lange wollen Sie eine Temperatur bekommen? (min) "))
runTime = runTime * 60
for i in range(runTime):
           tData = AktuelleTemperatur()
           print("Die Temperatur beträgt: ",tData,"°C")
           time.sleep(1)
            
print("Fertig!")
