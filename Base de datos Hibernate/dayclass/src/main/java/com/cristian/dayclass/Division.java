/package com.cristian.dayclass;

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
@Table(name="Division", schema="dayclass")
public class Division implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaAltaCurso;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaFinCurso;
    private String nombreDivision;
    
    @ManyToOne
    private Modalidad modalidad;
    
    
    public Division(){
        
    }

    public Date getFechaAltaCurso() {
        return fechaAltaCurso;
    }

    public void setFechaAltaCurso(Date fechaAltaCurso) {
        this.fechaAltaCurso = fechaAltaCurso;
    }

    public Date getFechaFinCurso() {
        return fechaFinCurso;
    }

    public void setFechaFinCurso(Date fechaFinCurso) {
        this.fechaFinCurso = fechaFinCurso;
    }

    public String getNombreDivision() {
        return nombreDivision;
    }

    public void setNombreDivision(String nombreDivision) {
        this.nombreDivision = nombreDivision;
    }

    public Modalidad getModalidad() {
        return modalidad;
    }

    public void setModalidad(Modalidad modalidad) {
        this.modalidad = modalidad;
    }
    
    
}
