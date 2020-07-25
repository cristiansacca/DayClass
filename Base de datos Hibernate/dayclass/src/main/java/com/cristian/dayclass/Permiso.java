
package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

@Entity
@Table(name="Permiso", schema="dayclass")

public class Permiso implements Serializable{
    
     private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaDesdePer;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHastaPer;
    private String nombrePermiso;
    
    public Permiso() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public Date getFechaDesdePer() {
        return fechaDesdePer;
    }

    public Date getFechaHastaPer() {
        return fechaHastaPer;
    }

    public String getNombrePermiso() {
        return nombrePermiso;
    }

    public void setFechaDesdePer(Date fechaDesdePer) {
        this.fechaDesdePer = fechaDesdePer;
    }

    public void setFechaHastaPer(Date fechaHastaPer) {
        this.fechaHastaPer = fechaHastaPer;
    }

    public void setNombrePermiso(String nombrePermiso) {
        this.nombrePermiso = nombrePermiso;
    }
    
}
