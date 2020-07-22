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


/**
 *
 * @author Cristian
 */
@Entity
@Table(name="CursoDia", schema="dayclass")
public class CursoDia implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaFinDia;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaInicioDia;
    private String nombreDia;
    
    public CursoDia(){
        
    }

    public Date getFechaFinDia() {
        return fechaFinDia;
    }

    public void setFechaFinDia(Date fechaFinDia) {
        this.fechaFinDia = fechaFinDia;
    }

    public Date getFechaInicioDia() {
        return fechaInicioDia;
    }

    public void setFechaInicioDia(Date fechaInicioDia) {
        this.fechaInicioDia = fechaInicioDia;
    }

    public String getNombreDia() {
        return nombreDia;
    }

    public void setNombreDia(String nombreDia) {
        this.nombreDia = nombreDia;
    }
    
    
    
}
